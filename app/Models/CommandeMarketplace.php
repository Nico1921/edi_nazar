<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CommandeMarketplace extends Model
{
    use HasFactory;

    protected $table = "commande_marketplace";
    protected $primaryKey = "id_commande";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'id_user_maj',
        'id_livraison',
        'id_etape',
        'date_ajout',
        'date_maj',
        'id_client',
        'date_commande',
        'num_commande',
        'quantite',
        'taux_tva',
        'montant_ht',
        'montant_tva',
        'montant_ttc',
        'remise_ttc',
        'frais_port_ht',
        'frais_port_tva',
        'frais_port_ttc',
        'due_ttc',
        'total_tva',
        'total_ht',
        'total_ttc',
        'date_facture',
        'num_facture',
        'date_env_order',
        'send_order',
        'date_env_invoice',
        'send_invoice',
        'commentaire',
        'gen_facture',
        'date_echeance',
        'statut',
        'nom_etape',
        'mode_reglement',
        'date_envoie',
        'env_order',
        'CGV',
        'id_distributeur',
        'md5_commande',
        'ref_externe',
        'commission_p',
        'commission_ht',
        'commission_ttc',
        'import',
        'total_eco_ht',
        'total_eco_ttc',
        'id_societe',
        'frais_supp_ht',
        'frais_supp_tva',
        'frais_supp_ttc',
        'infos',
        'frais_port_reel_ttc',
        'id_reduction',
        'provenance',
        'mode_livraison',
        'is_market',
        'date_expedition',
        'date_livraison',
        'date_delivery',
        'marge_ht',
        'is_ws',
        'id_transport',
        'poids',
        'order_id',
        'filled',
        'return_id',
        'total_refund',
        'tracking_sm',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id_user',
        'id_user_maj',
        'tracking_sm',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];


    /**
     * Permet la récupération des produits de la commande
     */
    public function commandeMKP()
    {
        return $this->hasOne(CommandeMarketplaceList::class,'id_commande','id_commande');
    }


    /**
     * Permet la récupération de l'étape de la commande
     */
    public function etape()
    {
        return $this->hasOne(EtapeMarketplace::class,'id_etape','id_etape');
    }

    /**
     * Permet la récupération de l'étape de la commande
     */
    public function commande_stock()
    {
        return $this->hasMany(CommandeStock::class,'id_commande_mkp','id_commande');
    }

    public static function generateNumOrder(){
        $search = CommandeMarketplace::where('num_commande','like',date('ym').'2%')->max('num_commande');
        $num_commande = date('ym').'20001';
        $unique = false;
        $tentative = 0;
        while(!$unique && $tentative < 10){
         if(!empty($search)){
            if(substr($search,0,4) == date('ym'))
               $num_commande = ($tentative > 3 ? $search+($tentative-2) : $search+1);
            else
               $num_commande = date('ym').'20001';
         }
         $check = CommandeMarketplace::where('num_commande','=',$num_commande)->get();
         if($check && count($check) == 0){
            $unique = true;
         }else{
            $tentative++;
         }
        }

        return $num_commande;
    }

    public static function add_commande($etape,$id_panier_edi,$paymentType,$id_distributeur){
        $clientsList = ClientEDI::where('id_panier_edi','=',$id_panier_edi)->get();
        $status = false;
        if(!empty($clientsList) && count($clientsList) > 0) {
           foreach($clientsList as $clientOne){     
              $panierList = PanierEdiList::where('id_client_edi','=',$clientOne->id_client_edi)->get();
              if(!empty($panierList) && count($panierList) > 0){
                 $num_client = ClientMarketplace::genNumClient();
                 $url_client = urlencode($clientOne->nom . '-' . $clientOne->prenom);
                 $clientMarketplace = ClientMarketplace::create([
                    'date_ajout' => date('Y-m-d H:i:s'),
                    'date_maj' => date('Y-m-d H:i:s'),
                    'id_user' => '0',
                    'id_user_maj' => '0',
                    'email' => $clientOne->email,
                    'num_client' => $num_client ,
                    'is_societe' => '0',
                    'civilite' => '',
                    'societe' => '',
                    'nom' => $clientOne->nom,
                    'prenom' => $clientOne->prenom,
                    'tva_intra' => null,
                    'siret' => null,
                    'adresse1' => $clientOne->adresse1_facturation,
                    'adresse2' => $clientOne->adresse2_facturation,
                    'adresse3' => $clientOne->adresse3_facturation,
                    'code_postal' => $clientOne->code_postal_facturation,
                    'ville' => $clientOne->ville_facturation,
                    'pays' => $clientOne->pays_facturation,
                    'tel1' => $clientOne->tel_facturation,
                    'tel2' => '',
                    'fax' => '',
                    'url_client' => $url_client,
                    'commentaire' => '',
                    'newsletter' => '0',
                    'id_type_client' => '1',
                    'commission' => '0',
                    'code_compta' => null,
                 ]);
 
                 $adresseMarketplace = AdresseMarketplace::create([
                    'date_ajout' => date('Y-m-d H:i:s'),
                    'date_maj' => date('Y-m-d H:i:s'),
                    'id_user' => '0',
                    'id_user_maj' => '0',
                    'id_client' => $clientMarketplace->id_client,
                    'adresse1' => $clientOne->adresse1,
                    'adresse2' => $clientOne->adresse2,
                    'adresse3' => $clientOne->adresse3,
                    'code_postal' => $clientOne->code_postal,
                    'ville' => $clientOne->ville,
                    'pays' => $clientOne->pays,
                    'nom_contact' => $clientOne->nom_adresse,
                    'tel1' => $clientOne->tel,
                    'email' => $clientOne->email,
                    'code1' => null,
                    'code2' => null,
                    'delai' => null,
                    'note' => null,
                    'pr_nom' => null,
                    'pr_id' => null,
                    'is_pr' => 0,
                    'id_commande' => '0',
                    'tel2' => '',
                    'is_relai' => '',
                 ]);
 
                 $userLogin = User::find($id_distributeur);
 
                 $commandeMarketplace = CommandeMarketplace::create([
                    'id_user' => 0,
                    'id_user_maj' => 0,
                    'id_livraison' => $adresseMarketplace->id_adresse,
                    'id_etape' => $etape,
                    'date_ajout' => date('Y-m-d H:i:s'),
                    'date_maj' => date('Y-m-d H:i:s'),
                    'id_client' => $clientMarketplace->id_client,
                    'date_commande' => $clientOne->date_commande,
                    'num_commande' => CommandeMarketplace::generateNumOrder(),
                    'quantite' => $clientOne->quantiter,
                    'taux_tva' => 20,
                    'montant_ht' => $clientOne->total_ht,
                    'montant_tva' => $clientOne->total_taxe,
                    'montant_ttc' => $clientOne->total_ttc,
                    'remise_ttc' => '0',
                    'frais_port_ht' => '0',
                    'frais_port_tva' => '0',
                    'frais_port_ttc' => '0',
                    'due_ttc' => '0',
                    'total_tva' => $clientOne->total_taxe,
                    'total_ht' => $clientOne->total_ht,
                    'total_ttc' => $clientOne->total_ttc,
                    'date_facture' => NULL,
                    'num_facture' => NULL,
                    'date_env_order' => NULL,
                    'send_order' => 0,
                    'date_env_invoice' => NULL,
                    'send_invoice' => 0,
                    'commentaire' => '',
                    'gen_facture' => 0,
                    'date_echeance' => $clientOne->date_commande,
                    'statut' => '0',
                    'nom_etape' => 'en attente de validation',
                    'mode_reglement' => '0',
                    'date_envoie' => NULL,
                    'env_order' => 0,
                    'CGV' => 0,
                    'id_distributeur' => $userLogin->id_client,
                    'md5_commande' => '',
                    'ref_externe' => $clientOne->num_commande,
                    'commission_p' => 0,
                    'commission_ht' => 0,
                    'commission_ttc' => 0,
                    'import' => 0,
                    'total_eco_ht' => 0,
                    'total_eco_ttc' => 0,
                    'id_societe' => 1,
                    'frais_supp_ht' => 0,
                    'frais_supp_tva' => 0,
                    'frais_supp_ttc' => 0,
                    'infos' => '',
                    'frais_port_reel_ttc' => 0,
                    'id_reduction' => NULL,
                    'provenance' => 1,
                    'mode_livraison' => NULL,
                    'is_market' => 1,
                    'date_expedition' => '0000-00-00',
                    'date_livraison' => NULL,
                    'date_delivery' => NULL,
                    'marge_ht' => 0,
                    'is_ws' => 1,
                    'id_transport' => 1,
                    'poids' =>  $clientOne->poids,
                    'order_id' => 0,
                    'filled' => 0,
                    'return_id' => 0,
                    'total_refund' => 0,
                    'tracking_sm' => 0,
                 ]);
 
                 $commandeMarketplace->md5_commande = md5($commandeMarketplace->id_commande);
                 $commandeMarketplace->save();
 
                 $adresseMarketplace->id_commande = $commandeMarketplace->id_commande;
                 $adresseMarketplace->save();
 
                 foreach($panierList as $produitCommande){
                    $p = Produit::with(['dimension','couleur'])->where('id_produit','=',$produitCommande->id_produit)->first();
                    $gamme = Gamme::where('id_gamme','=',$p->gamme_id)->first();
 
                    $prix_achat_ht = $gamme->prix_achat_ht_m2 * ($p->dimension->longueur / 100 * $p->dimension->largeur / 100);
                    $prix_achat_ht = sprintf("%.2f", $prix_achat_ht);
 
                    $commandeList = CommandeMarketplaceList::create([
                       'id_commande' =>$commandeMarketplace->id_commande,
                       'id_produit' => $produitCommande->id_produit,
                       'ref_produit' => $p->code_sku,
                       'nom_produit' => $gamme->nom_gamme." - ".$p->design." ".$p->couleur->nom_couleur." ".$p->dimension->largeur."x".$p->dimension->longueur,
                       'quantite' => $produitCommande->quantiter,
                       'taux_tva' => 20,
                       'prix_ht' => $produitCommande->prix_ht_unitaire,
                       'prix_ttc' => $produitCommande->prix_ttc_unitaire,
                       'eco_ttc',
                       'remise',
                       'commission_p',
                       'commission_ttc',
                       'frais_port_ttc',
                       'total_tva' => $produitCommande->prix_taxe_total,
                       'total_ht' => $produitCommande->prix_ht_total,
                       'total_ttc' => $produitCommande->prix_ttc_total,
                       'frais_port_ht' => 0,
                       'total_port_ttc' => 0,
                       'total_port_ht' => 0,
                       'total_eco_ht' => 0,
                       'total_eco_ttc' => 0,
                       'ref_couleur' => NULL,
                       'nom_couleur' => NULL,
                       'barcode' => '',
                       'id_categorie' => NULL,
                       'code_EAN' => $p->gencode,
                       'remise_sup_ttc' => 0,
                       'prix_achat_ht' => $prix_achat_ht,
                       'pourcentage_produit' => 0,
                       'delai' => NULL,
                       'note' => '',
                       'qte_preparee' => 0,
                       'date_preparee' => NULL,
                       'rupture' => 0,
                       'manuel' => 0,
                       'order_item_id' => '',
                    ]);

                    CommandeStock::create([
                     'id_commande' => '',
                     'id_commande_list' => '',
                     'id_produit' => $produitCommande->id_produit,
                     'id_stock' => 0,
                     'quantite' => $produitCommande->quantiter,
                     'etape' => 2,
                     'id_preparation' => 0,
                     'id_livraison' => 0,
                     'id_facture' => NULL,
                     'id_commande_mkp' => $commandeMarketplace->id_commande,
                     'id_commande_mkp_list' => $commandeList->id_commande_list,
                     'date_expedition' => NULL,
                     'tracking' => '',
                     'qte_preparee' => 0
                    ]);
                 }
 
                 if(isset($commandeMarketplace->id_commande) && !empty($commandeMarketplace->id_commande) && $commandeMarketplace->id_commande > 0){
                  PaiementMarketplace::create([
                     'id_commande' => $commandeMarketplace->id_commande,
                     'date_ajout' => date('Y-m-d H:i:s'),
                     'date_maj' => date('Y-m-d H:i:s'),
                     'payment_type' => 4,
                     'nature' => $commandeMarketplace->ref_externe,
                     'transaction' => $commandeMarketplace->ref_externe,
                     'date_payment' => date('Y-m-d'),
                     'amount_ttc'=> $commandeMarketplace->total_ttc,
                     'bank_charges' => '',
                     'comments'  => '',
                     'pdf_paiement'  => '',
                     'id_avoir'  => '',
                     'id_client' => $clientMarketplace->id_client
                  ]);
                  $status = true;
                 }
              }
           }
           $panierGet = PanierEdi::where('id_panier_edi', '=', $id_panier_edi)->first();
           if(isset($panierGet->id_panier_edi) && $panierGet->id_panier_edi > 0){
                $panierEdi = PanierEdi::where('id_panier_edi','=',$id_panier_edi)->first();
                $panierEdi->is_validate = 1;
                $panierEdi->id_etape = $etape;
                $panierEdi->total_payer = ($paymentType == 2 ? $panierGet->total_ttc : '0');
                $panierEdi->payment_type = $paymentType;
                $panierEdi->date_commande = date('Y-m-d');
                $panierEdi->date_livraison = ($paymentType == 2 ? date('Y-m-d', strtotime('NOW + 72 HOURS')) : '');
                $panierEdi->save();
           }
        }
        return $status;
    }

}
