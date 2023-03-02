<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeList;
use App\Models\CommandeMarketplace;
use App\Models\Facture;
use App\Models\Gamme;
use App\Models\Organisme;
use App\Models\Payment;
use App\Models\Produit;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PDFController extends Controller
{
    public function generatePDF_facture(Request $request){
        $param = $request->input('param');
        $organisme = Organisme::find('1')->first();
        $commande = Commande::where('num_commande_interne','=',$request->num_commande)->latest('date_ajout')->first();
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
                        $gamme = Gamme::where('id_gamme','=',$produit[$j]->design->id_gamme)->first();
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
                $html = view('PDF/facture_MKP', compact('organisme','commande','facture','user','commandeList','commandeListCount','commandeListSum','payment','paymentCount','produits','param','page'));
                $pdf->loadHtml($html,'UTF-8');
                $pdf->render();
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
            return $pdf->stream('facture_commande_'.$request->num_commande.'.pdf');
        }else{
            return redirect()->back();
        }
    }  

    public function generatePDF_proforma(Request $request){
        $param = $request->input('param');
        $organisme = Organisme::find('1')->first();
        $commande = Commande::where('num_commande_interne','=',$request->num_commande)->latest('date_ajout')->first();
        if(!empty($commande->id_commande)){
            $facture = Facture::where('id_commande','=',$commande->id_commande)->first();
            $facture->gen_facture = 0; 
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
                        $gamme = Gamme::where('id_gamme','=',$produit[$j]->design->id_gamme)->first();
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
                $html = view('PDF/facture_MKP', compact('organisme','commande','facture','user','commandeList','commandeListCount','commandeListSum','payment','paymentCount','produits','param','page'));
                $pdf->loadHtml($html,'UTF-8');
                $pdf->render();
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
            return $pdf->stream('facture_commande_'.$request->num_commande.'.pdf');
        }else{
            return redirect()->back();
        }
    }  
}

