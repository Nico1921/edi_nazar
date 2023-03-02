<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatsProduit extends Model
{
    use HasFactory;

    protected $table = "stats_produit";
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
        'id_produit',
        'qte_achetee',
        'qte_commande',
        'qte_arrivage',
        'stock_restant',
        'stock_option',
        'stock_bloque',
        'qte_destocke',
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
        'date_maj' => 'datetime',
    ];

    /**
     * Permet la récupération du produit lier au stats du produit
     */
    public function produit()
    { 
        return $this->hasOne(Produit::class,'id_produit','id_produit'); 
    }
}
