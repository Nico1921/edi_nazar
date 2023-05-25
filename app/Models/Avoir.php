<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avoir extends Model
{
    use HasFactory;

    protected $table = "avoir";
    protected $primaryKey = "id_avoir";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_commande',
        'id_facture',
        'id_client',
        'date_ajout',
        'date_maj',
        'date_avoir',
        'id_user',
        'id_user_maj',
        'num_avoir',
        'lib_avoir',
        'montant_ttc',
        'taux_tva',
        'montant_ht',
        'montant_tva',
        'gen_avoir',
        'utilise'
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

    ];
}
