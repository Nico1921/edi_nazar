<?php

namespace App\Mail;

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\DB;
use App\Models\Commande;
use App\Models\CommandeList;
use Dompdf\Options;
use App\Models\CommandeMarketplace;
use App\Models\Facture;
use App\Models\Gamme;
use App\Models\Organisme;
use App\Models\Payment;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class confirmationCommande extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $commande;

    public function __construct($commande)
    {
        $this->commande = $commande;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Confirmation Commande',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.confirmationCommande',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    /**
     * Create mail
     * 
     */
    public function build()
    {        
        $facture = $this->getFacture();    
        $user = User::with(['client'])->where('id','=',auth()->id())->first();
        return $this->subject('Confirmation commande') // ceci sera le sujet de l'e-mail
                    ->view('emails.confirmationCommande') // Ceci est le fichier contactMail.blade.php traité ci-après
                    ->with([
                        'order' => $this->commande,
                        'contact' => $user->client->contact
                    ])
                    ->attach($facture, [
                        'as' => "Facture_Nazar.pdf",
                        'mine' => 'application/pdf'
                    ]);
    }


    function getFacture(){
        $fileUrl = "" . tempnam(sys_get_temp_dir(), 'facture_commande_'.$this->commande) . '.pdf';
        $organisme = Organisme::find('1')->first();
        $commande = Commande::where('id_commande','=',$this->commande)->latest('date_ajout')->first();
        if(!empty($commande->id_commande)){
            $facture = Facture::where('id_commande','=',$commande->id_commande)->first();
            $user = User::with(['client'])->where('id','=',auth()->id())->first();
            if(!empty($user->id)) {
                $commandeList = CommandeList::where('id_facture','=',$facture->id_facture)->get();
                $commandeListCount = CommandeList::where('id_facture','=',$facture->id_facture)->where('remise','!=',0)->count();
                $commandeListSum = DB::table('commande_list')->select(DB::raw('(prix_ht-prix_remise_ht)*quantite as total'))->where('id_facture','=',$facture->id_facture)->where('remise','!=',0)->first();
                // $commandeListSum = CommandeList::where('id_facture','=',$facture->id_facture)->where('remise','!=',0)->sum('(prix_ht-prix_remise_ht)*quantite');
                $payment = Payment::where('id_facture','=',$facture->id_facture)->get();
                $paymentCount = Payment::where('id_facture','=',$facture->id_facture)->count();
                $produits = array();
                
                for($i=0;$i<count($commandeList);$i++){
                    $produit = Produit::with(['design','dimension','couleur'])->where('id_produit','=',$commandeList[$i]->id_produit)->get();
                    for($j=0;$j<count($produit);$j++){
                        $gamme = Gamme::where('id_gamme','=',$produit[$j]->gamme_id)->first();
                        $poids = Produit::calcul_poids($produit[$j]->id_produit,$commandeList[$i]->quantite);
                        $superficie = Produit::calcul_m2($produit[$j]->id_produit,$commandeList[$i]->quantite);
                        $produits[$i]['poids'] = $poids;
                        $produits[$i]['superficie'] = $superficie;
                        $produits[$i]['gamme'] = $gamme;
                        $produits[$i]['produit'] = $produit[$j];
                        $produits[$i]['commande'] = $commandeList[$i];
                    }
                 }
                 
                $produits = json_encode($produits);
                $produits = json_decode($produits);
                $pdf = app('dompdf.wrapper');
                $dompdf = $pdf->getDomPDF();

                $options = new Options();
                $options->setIsRemoteEnabled(true);
                $options->isPhpEnabled(true);
                $options->setIsJavascriptEnabled(true);
                $options->setTempDir(storage_path('tmp/'));
                $options->setLogOutputFile(storage_path('tmp/'). "log.htm");

                $dompdf->setOptions($options);
                $dompdf->set_option("enable_php", true);
                // $dompdf->set_option('tempDir','/ediV2.tapis-nazar.fr/storage/temps');

                $page = '';
                $html = view('PDF/facture_MKP', compact('organisme','commande','facture','user','commandeList','commandeListCount','commandeListSum','payment','paymentCount','produits','page'));
                $pdf->loadHtml($html,'UTF-8');
                $pdf->save($fileUrl);
                $canvas = $dompdf->getCanvas();
                $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
                    $text = "Page $pageNumber/$pageCount";
                    $font = 'Helvetica';
                    $pageWidth = $canvas->get_width();
                    $pageHeight = $canvas->get_height();
                    $size = 9;
                    $width = $fontMetrics->getTextWidth($text, $font, $size);
                    $canvas->text($pageWidth - $width - 20, $pageHeight - 20, $text, $font, $size);
                });
                
            }
        }
        
        return $fileUrl;
    }

}
