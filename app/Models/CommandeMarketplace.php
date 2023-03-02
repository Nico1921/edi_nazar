<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasOne(CommandeStock::class,'id_commande_mkp','id_commande');
    }

    public static function generateNumOrder(){
        $search = CommandeMarketplace::where('num_commande','like',date('ym').'2%')->max('num_commande');
        $num_commande = date('ym').'20001';
        if(!empty($search)){
                $num_commande = $search++;
        }

        return $num_commande;
    }

}
