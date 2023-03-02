<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdresseMarketplace extends Model
{
    use HasFactory;

    protected $table = "adresse_marketplace";
    protected $primaryKey = "id_adresse";
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
        'id_client',
        'adresse1',
        'adresse2',
        'adresse3',
        'code_postal',
        'ville',
        'pays',
        'nom_contact',
        'tel1',
        'email',
        'code1',
        'code2',
        'delai',
        'note',
        'pr_nom',
        'pr_id',
        'is_pr',
        'id_commande',
        'tel2',
        'is_relai',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id_user',
        'id_user_maj',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    /**
     * Permet la récupération de la commande lier a cette adresse
     */
    public function commande()
    {
        return $this->hasOne(CommandeMarketplace::class,'id_commande','id_commande');
    }
}
