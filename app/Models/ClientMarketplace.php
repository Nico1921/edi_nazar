<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientMarketplace extends Model
{
    use HasFactory;

    protected $table = "client_marketplace";
    protected $primaryKey = "id_client";
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
        'email',
        'num_client',
        'is_societe',
        'civilite',
        'societe',
        'nom',
        'prenom',
        'tva_intra',
        'siret',
        'adresse1',
        'adresse2',
        'adresse3',
        'code_postal',
        'ville',
        'pays',
        'tel1',
        'tel2',
        'fax',
        'url_client',
        'commentaire',
        'newsletter',
        'id_type_client',
        'commission',
        'code_compta',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id_user',
        'id_user_maj',
        'is_client',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_maj' => 'datetime',
    ];

    public static function genNumClient()
    {
        $num_client = 'edi-' . mt_rand(0001, 9999);
        $numClientCheck = ClientMarketplace::where('num_client', '=', $num_client)->count('*');
        while ($numClientCheck > 0) {
            $num_client = 'edi-' . mt_rand(0001, 9999);
            $numClientCheck = ClientMarketplace::where('num_client', '=', $num_client)->count('*');
        }

        return $num_client;
    }
}
