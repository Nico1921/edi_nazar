<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanierEdiList extends Model
{
    use HasFactory;

    protected $table = "panier_edi_list";
    protected $primaryKey = "id_panier_edi_list";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date_ajout',
        'date_maj',
        'id_produit',
        'prix_ht_unitaire',
        'prix_taxe_unitaire',
        'prix_ttc_unitaire',
        'quantiter',
        'prix_ht_total',
        'prix_taxe_total',
        'prix_ttc_total',
        'id_client_edi'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_maj' => 'datetime',
    ];

    /**
     * Permet la récupération du client lier a la liste du panier
     */
    public function produit()
    {
        return $this->hasOne(Produit::class,'id_produit','id_produit');
    }

    /**
     * Permet la récupération du client lier a la liste du panier
     */
    public function panier()
    {
        return $this->hasOne(ClientEDI::class,'id_client_edi','id_client_edi');
    }
}
