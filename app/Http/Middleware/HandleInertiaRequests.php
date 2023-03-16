<?php

namespace App\Http\Middleware;

use App\Models\Gamme;
use App\Models\PanierEdi;
use App\Models\PanierEdiList;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {
        if(isset($request->user()->id) && !empty($request->user()->id)){
            $user = $request->user()::with('client')->where('id','=',$request->user()->id)->get();
        }else {
            $user = '';
        }
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user,
            ],
            'dynamique_client' => function () use ($request){
                $dynamique_client = 1;
                if($request->session()->has('dynamique_client')){
                    $dynamique_client = $request->session()->get('dynamique_client');
                }
                return $dynamique_client;
            },
            'Panier' => function () use ($request){
                $panierCount = 0;
                $produitsAchat = new \stdClass;
                if($request->session()->has('panier_commercial') && !empty($request->session()->get('panier_commercial'))){
                    $id_client_edi = $request->session()->get('panier_commercial')->client_edi_list->id_client_edi;
                    $panierCount = PanierEdiList::where('id_client_edi','=',$id_client_edi)->sum('quantiter');
                    $panierList = PanierEdiList::where('id_client_edi','=',$id_client_edi)->get();
                    foreach($panierList as $list){
                        $produit = Produit::with(['photo','dimension','statsProduit','design','couleur'])->where('id_produit','=',$list->id_produit)->get();
                        for($i=0;$i<count($produit);$i++){
                            $gamme = Gamme::where('id_gamme','=',$produit[$i]->design->id_gamme)->first();
                            $panier = PanierEdiList::with('panier')->where('id_panier_edi_list','=',$list->id_panier_edi_list)->first();
                            $produit[$i]->gamme = $gamme;
                            $produit[$i]->panier = $panier;
                            $produit[$i]->id_panier_edi = $request->session()->get('panier_commercial')->id_panier_edi;
                            $produit[$i]->isInPanier = true;
                            $produitsAchat->panier[] = $produit[$i];
                        }
                    }
                }
                return ['count' => $panierCount,'panier' => $produitsAchat];
            },
            'PanierDrop' => function() use($request) {
                $panierCountF = 0;
                $produitsAchat = new \stdClass;
                if($request->session()->has('typeVente') && $request->session()->get('typeVente') == 2){
                    if($request->session()->has('panier_mkp') && !empty($request->session()->get('panier_mkp'))){
                        $panier = $request->session()->get('panier_mkp');
                        $panierGet = PanierEdi::with('client_edi_list')->find($panier->id_panier_edi);
                        $produitsAchat->id_panier_edi = $panier->id_panier_edi;
                        if(isset($panierGet->client_edi_list) && $panierGet->client_edi_list != null ){
                            $clientList = $panierGet->client_edi_list;
                            for($i=0;$i<count($clientList);$i++){  
                                $id_client_edi = $clientList[$i]->id_client_edi;
                                $panierCount = PanierEdiList::where('id_client_edi','=',$id_client_edi)->sum('quantiter');
                                $panierCountF = $panierCountF + $panierCount; 
                                $panierList = PanierEdiList::with(["produit" => function($query) {
                                    $query->with(['photo','dimension','statsProduit','design' => function($query2) {
                                        $query2->with('gamme');
                                    },'couleur']);
                                }])->where('id_client_edi','=',$id_client_edi)->get();
                                $produits =array();
                                for($j=0;$j<count($panierList);$j++){
                                    $list = $panierList[$j];
                                    $produit = $list->produit;
                                    $gamme =  $produit->design->gamme;
                                    $panier = PanierEdiList::with('panier')->where('id_panier_edi_list','=',$list->id_panier_edi_list)->first();
                                    $produit->prixProduit = Produit::calcul_prix_produit($produit->id_produit);
                                    $produit->gamme = $gamme;
                                    $produit->panier = $panier;
                                    $produit->isInPanier = true;
                                    $produit->quantiter = $list->quantiter;
                                    $produit->id_panier_edi_list = $list->id_panier_edi_list;
                                    array_push($produits,$produit);
                                }
                                $produitsAchat->clients[$i] = ["client"=>$clientList[$i],"produits" => $produits,'nbProduit' => $panierCount];
                                if ($request->session()->has('client_actuel')) {
                                    $client = $request->session()->get('client_actuel');
                                }else{
                                    $client = new \stdClass;
                                }
                                $produitsAchat->clientActuel = $client; 
                            } 
                        }


                    }
                }
                return ['count' => $panierCountF,'panier' => $produitsAchat];
            },
            'session' => function () use ($request) {
                return $request->session()->all();
            },
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
