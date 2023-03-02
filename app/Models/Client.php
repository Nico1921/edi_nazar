<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = "client";
    protected $primaryKey = "id_client";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'num_client',
        'nom_societe',
        'tva_intra',
        'contact',
        'email',
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
        'is_validate',
        'date_ajout',
        'id_user',
        'id_user_maj',
        'is_client',
        'is_fournisseur',
        'has_distributeur',
        'is_edi',
        'taux_remise',
        'social_twitter',
        'social_insta',
        'social_facebook',
        'social_linkedin',
        'social_website',
        'path_kbis',
        'path_identiter'
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
        'is_fournisseur',
        'has_distributeur',
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
     * Fonction qui permet la récupération de l'utilisateur lier au client
     */
    public function user()
    {
        return $this->belongsTo(User::class,'id_client','id_client');
    }
}
