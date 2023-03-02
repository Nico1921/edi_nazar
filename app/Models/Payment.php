<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payment";
    protected $primaryKey = "id_payment";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_commande',
        'id_facture',
        'date_ajout',
        'date_maj',
        'payment_type',
        'nature',
        'transaction',
        'date_payment',
        'amount_ttc',
        'bank_charges',
        'comments',
        'id_avoir'
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
