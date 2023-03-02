<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeList extends Model
{
    use HasFactory;

    protected $table = "commande_list";
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
        'date_saisie',
        'id_commande',
        'id_produit',
        'code_sku',
        'gencode',
        'prix_achat_ht',
        'prix_ht',
        'prix_total_ht',
        'prix_total_ttc',
        'taux_tva',
        'quantite',
        'remise',
        'prix_remise_ht',
        'total_tva',
        'note',
        'id_facture',
        'id_transporteur',
        'num_colis',
        'statut',
        'drop_shipping',
        'etat',
        'date_livraison'
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
     * Permet la récupération de la commande
     */
    public function commande()
    {
        return $this->hasOne(Commande::class,'id_commande','id_commande');
    }

    /**
     * Permet la récupération du produit
     */
    public function produit()
    {
        return $this->hasOne(Produit::class,'id_produit','id_produit');
    }
}
