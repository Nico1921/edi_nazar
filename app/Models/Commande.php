<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\confirmationCommande;
use stdClass;

class Commande extends Model
{
    use HasFactory;

    protected $table = "commande";
    protected $primaryKey = "id_commande";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date_ajout',
        'date_maj',
        'id_user',
        'id_user_maj',
        'id_client',
        'date_commande',
        'num_commande',
        'total_ttc',
        'taux_tva',
        'total_ht',
        'total_tva',
        'due_ttc',
        'commentaire',
        'mois',
        'mois2',
        'num_commande_interne'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id_user',
        'id_user_maj',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    /**
     * Permet la récupération du client de la commande
     */
    public function client()
    {
        return $this->hasOne(Client::class,'id_client','id_client');
    }

    public static function generateNumOrder(){
        $search = CommandeMarketplace::where('num_commande','like',date('y').'%')->max('num_commande');
        $num_commande = date('y').'0001';
        if(!empty($search)){
                $num_commande = $search++;
        }

        return $num_commande;
    }

    public static function create_facture($id_panier_edi,$paymentType = 1,$id_distributeur){
        $panier = PanierEdi::where('id_panier_edi','=',$id_panier_edi)->first();
        $commande = new stdClass;
        $facture = new stdClass;
        $preparation = new stdClass;
        if(!empty($panier->id_panier_edi) && $panier->id_panier_edi > 0){
            $id_client = User::with('client')->where('id','=',$id_distributeur)->first(); 
            if($panier->is_marketplace == 0){
                $clientGet = ClientEDI::where('id_panier_edi','=',$id_panier_edi)->first();
                $adresseCheck = Adresse::where('id_client','=',$id_client->client->id_client)
                                ->where('nom_contact','=',$clientGet->nom_adresse)
                                ->where('adresse1','=',$clientGet->adresse1)
                                ->where('adresse2','=',$clientGet->adresse2)
                                ->where('adresse3','=',$clientGet->adresse3)
                                ->where('code_postal','=',$clientGet->code_postal)
                                ->where('ville','=',$clientGet->ville)
                                ->where('pays','=',$clientGet->pays)
                                ->where('tel1','=',$clientGet->tel)->exists();
                if($adresseCheck){
                    $adresse = Adresse::where('id_client','=',$id_client->client->id_client)
                    ->where('nom_contact','=',$clientGet->nom_adresse)
                    ->where('adresse1','=',$clientGet->adresse1)
                    ->where('adresse2','=',$clientGet->adresse2)
                    ->where('adresse3','=',$clientGet->adresse3)
                    ->where('code_postal','=',$clientGet->code_postal)
                    ->where('ville','=',$clientGet->ville)
                    ->where('pays','=',$clientGet->pays)
                    ->where('tel1','=',$clientGet->tel)
                    ->first();
                }else{
                    $adresse = Adresse::create([
                        'date_ajout' => date('Y-m-d H:i:s'),
                        'date_maj' => date('Y-m-d H:i:s'),
                        'id_user' => '0',
                        'id_user_maj' => '0',
                        'id_client' => $id_client->client->id_client,
                        'nom_contact' => $clientGet->nom_adresse,
                        'adresse1' => $clientGet->adresse1,
                        'adresse2' => $clientGet->adresse2,
                        'adresse3' => $clientGet->adresse3,
                        'code_postal' => $clientGet->code_postal,
                        'ville' => $clientGet->ville,
                        'pays' => $clientGet->pays,
                        'tel1' => $clientGet->tel,
                        'tel2' => '',
                        'statut' => '1',
                    ]);
                }
                
            }else{
                $adresseCheck = Adresse::where('id_client','=',$id_client->client->id_client)
                                ->where('nom_contact','=',$id_client->client->nom_adresse)
                                ->where('adresse1','=',$id_client->client->adresse1)
                                ->where('adresse2','=',$id_client->client->adresse2)
                                ->where('adresse3','=',$id_client->client->adresse3)
                                ->where('code_postal','=',$id_client->client->code_postal)
                                ->where('ville','=',$id_client->client->ville)
                                ->where('pays','=',$id_client->client->pays)
                                ->where('tel1','=',$id_client->client->tel)->exists();
                if($adresseCheck){
                    $adresse = Adresse::where('id_client','=',$id_client->client->id_client)
                    ->where('nom_contact','=',$id_client->client->nom_adresse)
                    ->where('adresse1','=',$id_client->client->adresse1)
                    ->where('adresse2','=',$id_client->client->adresse2)
                    ->where('adresse3','=',$id_client->client->adresse3)
                    ->where('code_postal','=',$id_client->client->code_postal)
                    ->where('ville','=',$id_client->client->ville)
                    ->where('pays','=',$id_client->client->pays)
                    ->where('tel1','=',$id_client->client->tel)
                    ->first();
                }else{
                    $adresse = Adresse::create([
                        'date_ajout' => date('Y-m-d H:i:s'),
                        'date_maj' => date('Y-m-d H:i:s'),
                        'id_user' => '0',
                        'id_user_maj' => '0',
                        'id_client' => $id_client->client->id_client,
                        'nom_contact' => $id_client->client->nom_societe,
                        'adresse1' => $id_client->client->adresse1,
                        'adresse2' => $id_client->client->adresse2,
                        'adresse3' => $id_client->client->adresse3,
                        'code_postal' => $id_client->client->code_postal,
                        'ville' => $id_client->client->ville,
                        'pays' => $id_client->client->pays,
                        'tel1' => $id_client->client->tel1,
                        'tel2' => '',
                        'statut' => '1',
                    ]);
                }
                
            }
                        



                        $commande = Commande::create([
                            'date_ajout' => date('Y-m-d H:i:s'),
                            'date_maj' => date('Y-m-d H:i:s'),
                            'id_user' => '0',
                            'id_user_maj' => '0',
                            'id_client' => $id_client->client->id_client,
                            'date_commande' => date('Y-m-d H:i:s'),
                            'num_commande' => Commande::generateNumOrder(),
                            'total_ttc' => $panier->total_ttc,
                            'taux_tva' => '20',
                            'total_ht' => $panier->total_HT,
                            'total_tva' => $panier->total_taxe,
                            'due_ttc' => ($paymentType == 2 ? '0' : $panier->total_ttc),
                            'commentaire' => 'Commande EDI',
                            'mois' => '',
                            'mois2' => null,
                            'num_commande_interne' => $panier->num_commande
                        ]);

                        $facture = Facture::create([
                            'date_ajout' => date('Y-m-d H:i:s'),
                            'date_maj' => date('Y-m-d H:i:s'),
                            'id_commande' => $commande->id_commande,
                            'date_proforma' => date('Y-m-d'),
                            'num_proforma' => Facture::genNumProforma(),
                            'date_facture' => ($paymentType == 2 ? date('Y-m-d') : ''),
                            'num_facture' => ($paymentType == 2 || $id_client->client->paiement_comptant == 0 ? Facture::genNumFacture() : ''),
                            'montant_ttc' => $panier->total_ttc,
                            'taux_tva' => 20,
                            'montant_ht' => $panier->montant_ht,
                            'total_ht' => $panier->total_HT,
                            'montant_tva' => $panier->total_taxe,
                            'montant_due_ttc' => $panier->total_ttc - $panier->total_payer,
                            'montant_port_ht' => $panier->prix_transport,
                            'date_echeance' => ($id_client->client->paiement_comptant == 1 ? date('Y-m-d') : (date('d')<15? date('Y-m-t'): date('Y-m-d', strtotime(date('Y-m-15').'+ 1 month')))),
                            'gen_facture' => ($paymentType == 2 ? 1 : 0),
                            'observation' => 'Commande EDI du '.date('d/m/Y'),
                            'interne' => 1,
                            'exoneration' => '',
                            'date_livraison' => ($paymentType == 2 ? date('Y-m-d',strtotime(date('Y-m-d').' + 14 days')) : ''),
                            'reference' => $commande->num_commande,
                            'commission_ttc' => 0,
                            'commission_ht' => 0,
                            'commission_tva' => 0,
                            'remboursement_ttc' => 0,
                            'remboursement_ht' => 0,
                            'remboursement_tva' => 0,
                            'abonnement_ttc' => 0,
                            'abonnement_ht' => 0,
                            'abonnement_tva' => 0
                        ]);

                        if($panier->is_marketplace == 0){
                            $preparation = Preparation::create([
                                "date_ajout" => date('Y-m-d H:i:s'),
                                "date_maj" => date('Y-m-d H:i:s'),
                                "id_commande" => $commande->id_commande,
                                'id_facture' => $facture->id_facture,
                                'date_livraison' => $facture->date_livraison,
                                'note' => 'CDE EDI ' . $commande->id_commande,
                                'id_client' => $id_client->client->id_client,
                                'id_adresse' => $adresse->id_adresse
                            ]);
                        }

            $clientList = ClientEDI::where('id_panier_edi','=',$id_panier_edi)->get();
            foreach($clientList as $client){
                $panierClient = PanierEdiList::where('id_client_edi','=',$client->id_client_edi)->get();
                if(count($panierClient) > 0){
                    $i = 1;
                        foreach ($panierClient as $produitCommande) {
                            $p = Produit::with(['dimension', 'design', 'couleur'])->where('id_produit', '=', $produitCommande->id_produit)->first();
                            $gamme = Gamme::where('id_gamme', '=', $p->gamme_id)->first();

                            $prix_achat_ht = $gamme->prix_achat_ht_m2 * ($p->dimension->longueur / 100 * $p->dimension->largeur / 100);
                            $prix_achat_ht = sprintf("%.2f", $prix_achat_ht);

                            $commandeList = CommandeList::where('id_commande','=',$commande->id_commande)->where('id_produit','=',$produitCommande->id_produit)->first();  
                            if(!empty($commandeList->id_commande) && $commandeList->id_commande > 0){
                                $commandeList->prix_total_ht = $commandeList->prix_total_ht + $produitCommande->prix_ht_total;
                                $commandeList->prix_total_ttc = $commandeList->prix_total_ttc + $produitCommande->prix_ttc_total;
                                $commandeList->quantite = intval($commandeList->quantite) + intval($produitCommande->quantiter);
                                CommandeList::where('id_commande_list','=',$commandeList->id_commande_list)->update(array('prix_total_ht' => $commandeList->prix_total_ht,'prix_total_ttc' => $commandeList->prix_total_ttc,'quantite' => $commandeList->quantite));
                                if($panier->is_marketplace == 0){
                                    CommandeStock::where('id_commande_list','=',$commandeList->id_commande_list)->update(array('quantite' => $commandeList->quantite));
                                }
                            }else{
                               $commandeList = CommandeList::create([
                                    'date_ajout' => date('Y-m-d H:i:s'),
                                    'date_maj' => date('Y-m-d H:i:s'),
                                    'id_user' => '0',
                                    'id_user_maj' => '0',
                                    'date_saisie'=> date('Y-m-d'),
                                    'id_commande' => $commande->id_commande,
                                    'id_produit' => $produitCommande->id_produit,
                                    'code_sku' => $p->code_sku,
                                    'gencode' => $p->gencode,
                                    'prix_achat_ht' => '',
                                    'prix_ht' => $produitCommande->prix_ht_unitaire,
                                    'prix_total_ht' => $produitCommande->prix_ht_total,
                                    'prix_total_ttc' => $produitCommande->prix_ttc_total,
                                    'taux_tva' => '20',
                                    'quantite' => $produitCommande->quantiter,
                                    'remise' => '',
                                    'prix_remise_ht' => '',
                                    'total_tva' => $produitCommande->prix_taxe_total,
                                    'note' => '',
                                    'id_facture' => $facture->id_facture,
                                    'id_transporteur' => 0,
                                    'num_colis' => '',
                                    'statut' => '1',
                                    'drop_shipping' => '2',
                                    'etat' => '1',
                                    'date_livraison' => null
                                ]);
                                if($panier->is_marketplace == 0){
                                    CommandeStock::create([
                                        'id_commande' => $commande->id_commande,
                                        'id_commande_list' => $commandeList->id_commande,
                                        'id_produit' => $produitCommande->id_produit,
                                        'id_stock' => 0,
                                        'quantite' => $produitCommande->quantiter,
                                        'etape' => 3,
                                        'id_preparation' => (isset($preparation->id_preparation) ? $preparation->id_preparation : 0),
                                        'id_livraison' => 0,
                                        'id_facture' => $facture->id_facture,
                                        'id_commande_mkp' => NULL,
                                        'id_commande_mkp_list' => NULL,
                                        'date_expedition' => NULL,
                                        'tracking' => '',
                                        'qte_preparee' => 0
                                    ]);
                                }
                            }
                            
                        }
                }
            }
            Mail::to($id_client->client->email)->send(new confirmationCommande($commande->id_commande));
            // Mail::to("nbertrandnazar@gmail.com")->send(new confirmationCommande($commande->id_commande));
        }       

        if(!empty($facture->id_facture) && $facture->id_facture){
            if($paymentType == 2){
                Payment::create([
                    'id_commande' => $commande->id_commande,
                    'id_facture' => $facture->id_facture,
                    'date_ajout' => date('Y-m-d H:i:s'),
                    'date_maj' => date('Y-m-d H:i:s'),
                    'payment_type' => 4,
                    'nature' => $commande->num_commande,
                    'transaction' => '',
                    'date_payment' => date('Y-m-d'),
                    'amount_ttc' => $commande->total_ttc,
                    'bank_charges' => 0,
                    'comments' => '',
                    'id_avoir' => 0
                ]);
            }
            return true;
        }else{
            return false;
        }
    }
}
