<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gamme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;
use stdClass;

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
     * Permet la récupération de la gamme lier au produit
     */
    public function gamme()
    {
        return $this->hasOne(Gamme::class,'id_gamme','gamme_id');
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

    public static function getAllCaracteristiquesDesign($isPaginate=false,$select=[]){
        $select[] = 'produit.design';
        Log::debug($select);
        if($isPaginate){
            $design = QueryBuilder::for(Produit::class)->select($select);
        }else{
            $design = Produit::select($select);
        }
        
        $design = $design->join('produits_features as cl', function ($join) {
            $join->on('cl.produit_id', '=', 'produit.id_produit')
                 ->where('cl.feature_id', '=', 1);
        })
        ->join('produits_features as long', function ($join) {
            $join->on('long.produit_id', '=', 'produit.id_produit')
                 ->where('long.feature_id', '=', 2);
        })
        ->join('produits_features AS lag', function ($join) {
            $join->on('lag.produit_id', '=', 'produit.id_produit')
                 ->where('lag.feature_id', '=', 3);
        })
        ->join('produits_features AS compo', function ($join) {
            $join->on('compo.produit_id', '=', 'produit.id_produit')
                 ->where('compo.feature_id', '=', 5);
        });

        return $design;
    }
    
    public static function getAllCaracteristiques($isPaginate=false){
        if($isPaginate){
            $produits = QueryBuilder::for(Produit::class)
            ->select([
                'produit.*', 
                DB::raw("REPLACE(REPLACE(cl.data_values, '[\"',''), '\"]', '') AS couleur"),
                DB::raw("REPLACE(REPLACE(long.data_values, '[\"',''), '\"]', '') AS longueur"),
                DB::raw("REPLACE(REPLACE(lag.data_values, '[\"',''), '\"]', '') AS largeur"),
                DB::raw("REPLACE(REPLACE(compo.data_values, '[\"',''), '\"]', '') AS composition"),
            ]);
        }else{
            $produits = Produit::select([
                'produit.*', 
                DB::raw("REPLACE(REPLACE(cl.data_values, '[\"',''), '\"]', '') AS couleur"),
                DB::raw("REPLACE(REPLACE(long.data_values, '[\"',''), '\"]', '') AS longueur"),
                DB::raw("REPLACE(REPLACE(lag.data_values, '[\"',''), '\"]', '') AS largeur"),
                DB::raw("REPLACE(REPLACE(compo.data_values, '[\"',''), '\"]', '') AS composition"),
            ]);
        }
        
        $produits = $produits->join('produits_features as cl', function ($join) {
            $join->on('cl.produit_id', '=', 'produit.id_produit')
                 ->where('cl.feature_id', '=', 1);
        })
        ->join('produits_features as long', function ($join) {
            $join->on('long.produit_id', '=', 'produit.id_produit')
                 ->where('long.feature_id', '=', 2);
        })
        ->join('produits_features AS lag', function ($join) {
            $join->on('lag.produit_id', '=', 'produit.id_produit')
                 ->where('lag.feature_id', '=', 3);
        })
        ->join('produits_features AS compo', function ($join) {
            $join->on('compo.produit_id', '=', 'produit.id_produit')
                 ->where('compo.feature_id', '=', 5);
        });

        return $produits;
    }

    public static function getOldCaracteristiqueProduit($produit){
        $couleur = $produit->couleur;
        $produit->couleur = new stdClass;
        $produit->couleur->nom_couleur = $couleur;

        $design = $produit->design;
        $produit->design = new stdClass;
        $produit->design->nom_design = $design;
        
        $produit->dimension = new stdClass;
        $produit->dimension->largeur = $produit->largeur;
        $produit->dimension->longueur = $produit->longueur;

        return $produit;
    }

    public static function getDimension($productId){
        $dimensions = Produit::select([
            'produit.*', 
            DB::raw('SUBSTRING(produits_features.data_values, 3, LENGTH(produits_features.data_values) - 4) AS largeur'), 
            DB::raw('SUBSTRING(produits_features_2.data_values, 3, LENGTH(produits_features_2.data_values) - 4) AS longueur')
        ])
        ->join('produits_features', function ($join) {
            $join->on('produits_features.produit_id', '=', 'produit.id_produit')
                 ->where('produits_features.feature_id', '=', 3);
        })
        ->join('produits_features AS produits_features_2', function ($join) {
            $join->on('produits_features_2.produit_id', '=', 'produit.id_produit')
                 ->where('produits_features_2.feature_id', '=', 2);
        })
        ->orderByRaw('CAST(SUBSTRING(produits_features.data_values, 3, LENGTH(produits_features.data_values) - 4) AS DECIMAL(10,2))')
        ->orderByRaw('CAST(SUBSTRING(produits_features_2.data_values, 3, LENGTH(produits_features_2.data_values) - 4) AS DECIMAL(10,2))')
        ->where('id_produit','=',$productId);
        return $dimensions;
    }

    public static function getProduitPanier($id_produit,$id_panier_edi,$panier,$panierGet)
    {
        $produit = Produit::getAllCaracteristiques()->with(['photo', 'gamme', 'statsProduit'])->where('id_produit', '=', $id_produit)->first();
        $gamme = $produit->gamme;
        $gamme->prix_vente_ht_m2_remise = Gamme::getM2withRemise($produit->gamme_id);
        $produit->gamme = $gamme;

        $produit->panier = $panier;

        $couleur = $produit->couleur;
        $produit->couleur = new stdClass;
        $produit->couleur->nom_couleur = $couleur;

        $design = $produit->design;
        $produit->design = new stdClass;
        $produit->design->nom_design = $design;

        $produit->dimension = new stdClass;
        $produit->dimension->largeur = $produit->largeur;
        $produit->dimension->longueur = $produit->longueur;
        $produit->panierActuel = $panierGet;
        $produit->id_panier_edi = $id_panier_edi;
        $produit->isInPanier = true;
        $produit->prix_produit = Produit::calcul_prix_produit($id_produit);

        return $produit;
    }

    public static function calcul_poids($id_produit, $qte){
        $poids = 0;
        $produit = Produit::getAllCaracteristiques()->with(['gamme'])->where('id_produit', '=', $id_produit)->first();
        $produit = Produit::getOldCaracteristiqueProduit($produit);
        if(!empty($produit->id_produit)){
            $gamme = $produit->gamme;
            $poids = $produit->dimension->largeur / 100 * $produit->dimension->longueur / 100 * $gamme->poids_m2_KG * $qte;
            $poids = sprintf('%01.2f', $poids);
        }
        
        return $poids;
    }

    public static function calcul_m2($id_produit, $qte){
        $superficie = 0;
        $produit = Produit::getAllCaracteristiques()->with(['gamme'])->where('id_produit', '=', $id_produit)->first();
        $produit = Produit::getOldCaracteristiqueProduit($produit);
        if(!empty($produit->id_produit)){
            $superficie = $produit->dimension->largeur / 100 * $produit->dimension->longueur / 100 * $qte;
            $superficie = sprintf('%01.2f', $superficie);
        }
        
        return $superficie;
    }

    public static function calcul_prix_produit($id_produit,$isTTC=0){
        $produit = Produit::getAllCaracteristiques()->where('id_produit', '=', $id_produit)->first();
        $produit = Produit::getOldCaracteristiqueProduit($produit);
        $gamme = Gamme::getM2withRemise($produit->gamme_id);
        $m2 = ($produit->dimension->largeur/100) * ($produit->dimension->longueur/100);
        $prixProduit = $gamme * $m2;
        

        if($isTTC){
            $prixProduit = ($prixProduit * 1.20);
        }

        return $prixProduit;
    }
}
