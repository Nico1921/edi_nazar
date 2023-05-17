<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gamme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Produit extends Model
{
    use HasFactory;

    protected $table = "produit";
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
        'id_design',
        'id_couleur',
        'id_dimension',
        'code_sku',
        'gencode',
        'prix_achat_ht',
        'prix_vente_ht',
        'prix_achat_ht_DS',
        'prix_vente_ht_DS',
        'prix_conseille_ttc',
        'prix_public_ttc',
        'statut',
        'drop_shipping',
        'stock',
        'nom_list',
        'gencode2',
        'reappro',
        'stock_mini',
        'stock_maxi',
        'is_ok',
        'id_produit_ref',
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
        'id_special',
        'id_couleur',
        'id_dimension',
        'id_produit_ref',
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
     * Permet la récupération du Design lier au produit
     */
    public function design()
    {
        return $this->hasOne(Design::class,'id_design','id_design');
    }

    /**
     * Permet la récupération de la gamme lier au produit
     */
    public function gamme()
    {
        return $this->hasOne(Gamme::class,'id_gamme','gamme_id');
    }

    /**
     * Permet la récupération de la couleur lier au produit
     */
    public function couleur()
    {
        return $this->hasOne(Couleur::class,'id_couleur','id_couleur');
    }

    /**
     * Permet la récupération de la dimension lier au produit
     */
    public function dimension()
    {
        return $this->hasOne(Dimension::class,'id_dimension','id_dimension');
    }

    /**
     * Permet la récupération du ou des photos 
     */
    public function photo()
    {
        return $this->belongsTo(Photo::class,'id_produit','id_produit');
    }

    /**
     * Permet la récupération du ou des stocks 
     */
    public function statsProduit()
    {
        return $this->belongsTo(StatsProduit::class,'id_produit','id_produit');
    }

    /**
     * Permet la récupération de la liste des panier lier au produits
     */
    public function panierEdiList()
    {
        return $this->belongsTo(PanierEdiList::class,'id_produit','id_produit');
    }

    public static function calcul_prix_livraison_drop($id_produit,$qte,$pays){
        $poids = Produit::calcul_poids($id_produit,$qte);
        $prixLivraison = 12.36;
        $exist = PaysLivraison::where('pays','=',$pays)->first();
        if(isset($exist->id_pays_livraison) && $exist->id_pays_livraison > 0){
            if($poids <= 30){
                $prixL = PaysLivraison::getPaysLivraison($pays,$poids);
                if(isset($prixL->id_pays_livraison) && $prixL->id_pays_livraison > 0){
                    $prixLivraison = $prixL->prix;
                }else{
                    $prixL = PaysLivraison::getPaysLivraison($pays,30);
                    $prixLivraison = $prixL->prix;
                }
            }else{
                $prixL = PaysLivraison::getPaysLivraison($pays,30);
                $prixLivraison = $prixL->prix;
            }
        }else{
            if($poids <= 30){
                $prixL = PaysLivraison::getPaysLivraison('France',$poids);
                if(isset($prixL->id_pays_livraison) && $prixL->id_pays_livraison > 0){
                    $prixLivraison = $prixL->prix;
                }else{
                    $prixL = PaysLivraison::getPaysLivraison('France',$poids);
                    $prixLivraison = $prixL->prix;
                }
            }else{
                $prixL = PaysLivraison::getPaysLivraison('France',30);
                $prixLivraison = $prixL->prix;
            }
        }

        return $prixLivraison;
    }

    public static function calcul_poids($id_produit, $qte){
        $poids = 0;
        $produit = Produit::with(['dimension','design'])->where('id_produit','=',$id_produit)->first();
        if(!empty($produit->id_produit)){
            $gamme = Gamme::where('id_gamme','=',$produit->gamme_id)->first();
            $poids = $produit->dimension->largeur / 100 * $produit->dimension->longueur / 100 * $gamme->poids_m2_KG * $qte;
            $poids = sprintf('%01.2f', $poids);
        }
        
        return $poids;
    }

    public static function calcul_m2($id_produit, $qte){
        $superficie = 0;
        $produit = Produit::with(['dimension','design'])->where('id_produit','=',$id_produit)->first();
        if(!empty($produit->id_produit)){
            $superficie = $produit->dimension->largeur / 100 * $produit->dimension->longueur / 100 * $qte;
            $superficie = sprintf('%01.2f', $superficie);
        }
        
        return $superficie;
    }

    public static function getPrixProduitwithRemise($prix,$id_gamme){
        $remise = false;
        $user = User::with('client')->where('id','=',Auth::id())->first();

        $gamme = Gamme::where('id_gamme','=',$id_gamme)->first();
        //Log::debug(clientEdiRemiseGamme::where('id_gamme', "=", $id_gamme)->where('id_client_edi', $user->id_client)->exists());
        if(ClientEdiRemiseGamme::where('id_gamme', "=", $id_gamme)->where('id_client_edi', $user->id_client)->exists()){
            $remise = ClientEdiRemiseGamme::where('id_gamme', "=", $id_gamme)->where('id_client_edi', $user->id_client)->first()->remise;
        }

        if(!$remise && $user->client->taux_remise > 0){
            $remise = $user->client->taux_remise;
        }

        if($remise){
            $prix = $prix - (($prix) * ($remise /100));
        }
        Log::debug(round($prix,2));
        return round($prix,2);
    }

    public static function calcul_prix_produit($id_produit,$isTTC=0){
        $produit = Produit::with(['dimension'])->where('id_produit','=',$id_produit)->first();
        $prixSpecifique = PrixProduitSpecifique::where('id_produit','=',$id_produit)->first();
        if(isset($prixSpecifique->id_prix_produit_specifique) && !empty($prixSpecifique->id_prix_produit_specifique) && $prixSpecifique->id_prix_produit_specifique > 0){
            $prixProduit = Produit::getPrixProduitwithRemise($prixSpecifique->prix,$produit->gamme_id);
        }else{
            $gamme = Gamme::getM2withRemise($produit->gamme_id);
            $m2 = ($produit->dimension->largeur/100) * ($produit->dimension->longueur/100);
            $prixProduit = $gamme * $m2;
        }
             
        if($isTTC){
            $prixProduit = ($prixProduit * 1.20);
        }

        return $prixProduit;
    }
}
