<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $table = "design";
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
        'nom_design',
        'id_gamme',
        'url_design',
        'statut',
        'sort_order',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id_gamme',
        'id_user',
        'id_user_maj',
        'id_design',
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
     * Permet la récupération de la gamme lier au Design
     */
    public function gamme()
    { 
        return $this->hasOne(Gamme::class,'id_gamme','id_gamme'); 
    }

    /**
     * Permet la récupération de la gamme lier au Design
     */
    public function produits()
    { 
        return $this->hasMany(Produit::class,'id_design','id_design'); 
    }
}
