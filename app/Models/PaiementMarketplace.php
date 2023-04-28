<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementMarketplace extends Model
{
    use HasFactory;

    protected $table = "paiement_marketplace";
    protected $primaryKey = "id_paiement";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_commande',
        'date_ajout',
        'date_maj',
        'payment_type',
        'nature',
        'transaction',
        'date_payment',
        'amount_ttc',
        'bank_charges',
        'comments',
        'pdf_paiement',
        'id_avoir',
        'id_client'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'date_ajout',
        'date_maj',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];
}
