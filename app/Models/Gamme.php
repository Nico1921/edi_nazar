<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;

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

    public static function getRequestGammeCaracteristiques() {
        $user = User::with('client')->where('id','=',Auth::id())->first();
        $resultats = QueryBuilder::for(Gamme::class)
        ->select('gamme.id_gamme','gamme.nom_gamme', 
            'gamme.prix_vente_ht_m2','gamme.img_gamme', 'client_edi_remise_gamme.remise AS remiseGamme',
            DB::raw("REPLACE(REPLACE(cf.data_values, '[\"',''), '\"]', '') AS nom_special"),
            DB::raw("REPLACE(REPLACE(fa.data_values, '[\"',''), '\"]', '') AS id_fabrication"),
            DB::raw("REPLACE(REPLACE(tp.data_values, '[\"',''), '\"]', '') AS type_poils"),
            DB::raw("CASE WHEN REPLACE(REPLACE(uv.data_values, '[\"',''), '\"]', '') = 'Oui' THEN 1 ELSE 0 END AS uv_proof"),
            DB::raw("REPLACE(REPLACE(tt.data_values, '[\"',''), '\"]', '') AS type_tapis")
        )
        ->leftJoin('client_edi_remise_gamme', function ($join) use ($user) {
            $join->on('client_edi_remise_gamme.id_gamme', '=', 'gamme.id_gamme')
                 ->where('client_edi_remise_gamme.id_client_edi', '=', $user->id_client);
        })
        ->join('gammes_features as cf', function ($join) {
            $join->on('gamme.id_gamme', '=', 'cf.gamme_id')
                ->where('cf.feature_id', '=', 5);
        })
        ->join('gammes_features as sp', function ($join) {
            $join->on('gamme.id_gamme', '=', 'sp.gamme_id')
                ->where('sp.feature_id', '=', 13)
                ->where('sp.data_values', 'LIKE', '%Oui%');
        })
        ->join('gammes_features as fa', function ($join) {
            $join->on('gamme.id_gamme', '=', 'fa.gamme_id')
                ->where('fa.feature_id', '=', 6);
        })
        ->join('gammes_features as tp', function ($join) {
            $join->on('gamme.id_gamme', '=', 'tp.gamme_id')
                ->where('tp.feature_id', '=', 10);
        })
        ->join('gammes_features as uv', function ($join) {
            $join->on('gamme.id_gamme', '=', 'uv.gamme_id')
                ->where('uv.feature_id', '=', 11);
        })
        ->join('gammes_features as tt', function ($join) {
            $join->on('gamme.id_gamme', '=', 'tt.gamme_id')
                ->where('tt.feature_id', '=', 12);
        });
        return $resultats;
    }

    public static function getGammeCaracteristiques($id_gamme) {
        $user = User::with('client')->where('id','=',Auth::id())->first();
        $resultats = DB::table('gamme as g')
            ->select('g.id_gamme','g.nom_gamme', 'g.prix_vente_ht_m2','g.img_gamme', 
            'client_edi_remise_gamme.remise AS remiseGamme',
            DB::raw("REPLACE(REPLACE(cf.data_values, '[\"',''), '\"]', '') AS nom_special"),
            DB::raw("REPLACE(REPLACE(fa.data_values, '[\"',''), '\"]', '') AS id_fabrication"),
            DB::raw("REPLACE(REPLACE(tp.data_values, '[\"',''), '\"]', '') AS type_poils"),
            DB::raw("CASE WHEN REPLACE(REPLACE(uv.data_values, '[\"',''), '\"]', '') = 'Oui' THEN 1 ELSE 0 END AS uv_proof"),
            DB::raw("REPLACE(REPLACE(tt.data_values, '[\"',''), '\"]', '') AS type_tapis")
            )
            ->leftJoin('client_edi_remise_gamme', function ($join) use ($user) {
                $join->on('client_edi_remise_gamme.id_gamme', '=', 'g.id_gamme')
                     ->where('client_edi_remise_gamme.id_client_edi', '=', $user->id_client);
            })
            ->join('gammes_features as cf', function ($join) {
                $join->on('g.id_gamme', '=', 'cf.gamme_id')
                    ->where('cf.feature_id', '=', 5);
            })
            ->join('gammes_features as sp', function ($join) {
                $join->on('g.id_gamme', '=', 'sp.gamme_id')
                    ->where('sp.feature_id', '=', 13)
                    ->where('sp.data_values', 'LIKE', '%Oui%');
            })
            ->join('gammes_features as fa', function ($join) {
                $join->on('g.id_gamme', '=', 'fa.gamme_id')
                    ->where('fa.feature_id', '=', 6);
            })
            ->join('gammes_features as tp', function ($join) {
                $join->on('g.id_gamme', '=', 'tp.gamme_id')
                    ->where('tp.feature_id', '=', 10);
            })
            ->join('gammes_features as uv', function ($join) {
                $join->on('g.id_gamme', '=', 'uv.gamme_id')
                    ->where('uv.feature_id', '=', 11);
            })
            ->join('gammes_features as tt', function ($join) {
                $join->on('g.id_gamme', '=', 'tt.gamme_id')
                    ->where('tt.feature_id', '=', 12);
            })
            ->where('g.statut', '=', 1)
            ->where('g.id_gamme', '=', $id_gamme)
            ->first();
        return $resultats;
    }

    public static function getAllDimensionGamme(){
        $dimensions = DB::table('produit')
            ->select([
                'gamme.id_gamme', 
                DB::raw('SUBSTRING(produits_features.data_values, 3, LENGTH(produits_features.data_values) - 4) AS largeur'), 
                DB::raw('SUBSTRING(produits_features_2.data_values, 3, LENGTH(produits_features_2.data_values) - 4) AS longueur')
            ])
            ->distinct()
            ->join('gamme', 'gamme.id_gamme', 'produit.gamme_id')
            ->join('produits_features', function ($join) {
                $join->on('produits_features.produit_id', '=', 'produit.id_produit')
                     ->where('produits_features.feature_id', '=', 3);
            })
            ->join('produits_features AS produits_features_2', function ($join) {
                $join->on('produits_features_2.produit_id', '=', 'produit.id_produit')
                     ->where('produits_features_2.feature_id', '=', 2);
            })
            ->join('gammes_features', function ($join) {
                $join->on('gammes_features.gamme_id', '=', 'gamme.id_gamme')
                     ->where('gammes_features.feature_id', '=', 13)
                     ->where('gammes_features.data_values', 'LIKE', '%Oui%');
            })
            ->where('gamme.statut', '=', '1')
            ->orderByRaw('CAST(SUBSTRING(produits_features.data_values, 3, LENGTH(produits_features.data_values) - 4) AS DECIMAL(10,2))')
            ->orderByRaw('CAST(SUBSTRING(produits_features_2.data_values, 3, LENGTH(produits_features_2.data_values) - 4) AS DECIMAL(10,2))')
            ->get();

        return $dimensions;
    }

    public static function setRemiseGamme($products, $isArray = true)
    {
        $user = User::with('client')->where('id', '=', Auth::id())->first();
        if ($isArray) {
            $products->each(function ($product) use ($user) {
                $remise = 0;
                if (isset($product->remiseGamme)) {
                    $remise = $product->remiseGamme;
                } elseif (isset($user->client->taux_remise)) {
                    $remise = $user->client->taux_remise;
                }
                if ($remise > 0) {
                    $product->prix_vente_ht_m2_remise = "" . round($product->prix_vente_ht_m2 * (1 - ($remise / 100)), 2) . "";
                } else {
                    $product->prix_vente_ht_m2_remise = false;
                }
            });
        } else {
            $remise = 0;
            if (isset($products->remiseGamme)) {
                $remise = $products->remiseGamme;
            } elseif (isset($user->client->taux_remise)) {
                $remise = $user->client->taux_remise;
            }
            if ($remise > 0) {
                $products->prix_vente_ht_m2_remise = "" . round($products->prix_vente_ht_m2 * (1 - ($remise / 100)), 2) . "";
            } else {
                $products->prix_vente_ht_m2_remise = false;
            }
        }

        return $products;
    }

    public static function getM2withRemise($id_gamme){
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

        $prixGamme = $gamme->prix_vente_ht_m2;

        if($remise){
            $prixGamme = $prixGamme - (($prixGamme) * ($remise /100));
        }
        
        return $prixGamme;
    }
}
