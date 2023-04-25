<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientEdiRemiseGamme extends Model
{
    use HasFactory;

    protected $table = 'Client_edi_remise_gamme';

    protected $fillable = [
        'id_remise_gamme',
        'date_ajout',
        'date_maj',
        'id_client_edi',
        'id_gamme',
        'remise'
    ];

    protected $primaryKey = 'id_remise_gamme';

    public $timestamps = false;


}
