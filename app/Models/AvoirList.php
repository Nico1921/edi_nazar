<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvoirList extends Model
{
    use HasFactory;

    protected $table = "avoir_list";
    protected $primaryKey = "id_avoir_list";
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
        'id_commande',
        'id_avoir',
        'id_commande_list',
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
        'statut',
        'drop_shipping',
        'designation',
        'is_supplement'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'date_ajout',
        'date_maj',
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
}
