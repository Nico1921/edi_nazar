<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Gamme extends Model
{
    use HasFactory;

    protected $table = "gamme";
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
        'nom_gamme',
        'composition',
        'id_special',
        'id_fabrication',
        'poids_m2_KG',
        'hauteur_mm',
        'url_gamme',
        'statut',
        'sort_order',
        'prix_achat_ht_m2',
        'img_gamme',
        'type_poils',
        'uv_proof',
        'type_tapis',
        'in_edi',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id_user',
        'id_user_maj',
        'id_special',
        'id_fabrication',
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
     * Permet la récupération du Design lier a la gamme
     */
    public function design()
    {
        return $this->belongsTo(Design::class,'id_design','id_design');
    }

    public static function getM2withRemise($id_gamme){
        $user = User::with('client')->where('id','=',Auth::id())->first();
        //$gamme = Gamme::getM2withRemise($produit->design->id_gamme);
		$gamme = Gamme::where('id_gamme','=',$id_gamme)->first();

        $prixGamme = $gamme->prix_vente_ht_m2;

        if($user->client->taux_remise > 0){
            $prixGamme = $prixGamme - (($prixGamme) * ($user->client->taux_remise /100));
        }

        return $prixGamme;
    }
}
