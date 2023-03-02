<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeStock extends Model
{
    use HasFactory;

    
    protected $table = "commande_stock";
    protected $primaryKey = "id_commande_stock";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_commande',
        'id_commande_list',
        'id_produit',
        'id_stock',
        'quantite',
        'etape',
        'id_preparation',
        'id_livraison',
        'id_facture',
        'id_commande_mkp',
        'id_commande_mkp_list',
        'date_expedition',
        'tracking',
        'qte_preparee'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id_preparation',
        'id_livraison',
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
        return $this->hasOne(CommandeMarketplace::class,'id_commande','id_commande_mkp');
    }
}
