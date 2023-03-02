<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = "photo";
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
        'img_produit',
        'principale',
        'statut',
        'sort_order',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id_produit',
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
     * Permet la récupération du produit lier a l'image
     */
    public function produit()
    { 
        return $this->hasOne(Produit::class,'id_produit','id_produit'); 
    }
}
