<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdresseEdi extends Model
{
    use HasFactory;

    protected $table = "adresse_edi";
    protected $primaryKey = "id_adresse_edi";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_adresse',
        'id_client',
        'nom_adresse',
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

    /**
     * Permet la récupération de l'adresse lier a cette ligne
     */
    public function adresse()
    {
        return $this->hasOne(Adresse::class,'id_adresse','id_adresse');
    }
}
