<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeMarketplaceList extends Model
{
    use HasFactory;

    protected $table = "commande_marketplace_list";
    protected $primaryKey = "id_commande_list";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_commande',
        'id_produit',
        'ref_produit',
        'nom_produit',
        'quantite',
        'taux_tva',
        'prix_ht',
        'prix_ttc',
        'eco_ttc',
        'remise',
        'commission_p',
        'commission_ttc',
        'frais_port_ttc',
        'total_tva',
        'total_ht',
        'total_ttc',
        'frais_port_ht',
        'total_port_ttc',
        'total_port_ht',
        'total_eco_ht',
        'total_eco_ttc',
        'ref_couleur',
        'nom_couleur',
        'barcode',
        'id_categorie',
        'code_EAN',
        'remise_sup_ttc',
        'prix_achat_ht',
        'pourcentage_produit',
        'delai',
        'note',
        'qte_preparee',
        'date_preparee',
        'rupture',
        'manuel',
        'order_item_id',
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
     * Permet la récupération de la commande lier a cette liste de commande
     */
    public function commande()
    {
        return $this->hasOne(CommandeMarketplace::class,'id_commande','id_commande');
    }
}
