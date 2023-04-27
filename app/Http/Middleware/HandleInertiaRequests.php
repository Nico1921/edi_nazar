<?php

namespace App\Http\Middleware;

use App\Models\Gamme;
use App\Models\PanierEdi;
use App\Models\PanierEdiList;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Inertia\Middleware;
use Illuminate\Support\Facades\DB;
use stdClass;
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
                if($request->session()->has('typeVente') && $request->session()->get('typeVente') == 1){
                    if($request->session()->has('panier_commercial') && !empty($request->session()->get('panier_commercial'))){
                        if(isset($request->session()->get('panier_commercial')->client_edi_list[0]->id_client_edi)){
                            $id_client_edi = $request->session()->get('panier_commercial')->client_edi_list[0]->id_client_edi;
                            $panierGet = PanierEdi::with(['client_edi_list'])->where('id_panier_edi', '=',  $request->session()->get('panier_commercial')->id_panier_edi)->first();
                            $request->session()->put('panier_commercial', $panierGet);
                            $panierCount = PanierEdiList::where('id_client_edi','=',$id_client_edi)->sum('quantiter');
                            $panierList = PanierEdiList::with('panier')->where('id_client_edi','=',$id_client_edi)->get();
                            foreach($panierList as $list){
                                $produitsAchat->panier[] = Produit::getProduitPanier($list->id_produit,$list->panier->id_panier_edi,$list,$panierGet);
                            }
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
                        $request->session()->put('panier_mkp',$panierGet);
                        $produitsAchat->id_panier_edi = $panier->id_panier_edi;
                        $produitsAchat->panierActuel = $panier;
                        if(isset($panierGet->client_edi_list) && $panierGet->client_edi_list != null ){
                            $clientList = $panierGet->client_edi_list;
                            $allAddValide = true;
                            $allPanierValide = true;
                            for($i=0;$i<count($clientList);$i++){  
                                $id_client_edi = $clientList[$i]->id_client_edi;
                                $panierCount = PanierEdiList::where('id_client_edi','=',$id_client_edi)->sum('quantiter');
                                $panierCountF = $panierCountF + $panierCount; 

                                $panierList = PanierEdiList::where('id_client_edi','=',$id_client_edi)->get();
                                $produits =array();
                                for($j=0;$j<count($panierList);$j++){
                                    $list = $panierList[$j]; 
                                    $produitClient = Produit::getAllCaracteristiques()->with(['photo','statsProduit','gamme'])->where('id_produit','=',$panierList[$j]->id_produit)->first();

                                    $couleur = $produitClient->couleur;
                                    $produitClient->couleur = new stdClass;
                                    $produitClient->couleur->nom_couleur = $couleur;

                                    $design = $produitClient->design;
                                    $produitClient->design = new stdClass;
                                    $produitClient->design->nom_design = $design;

                                    $produitClient->dimension->largeur = $produitClient->largeur;  
                                    $produitClient->dimension->longueur = $produitClient->longueur;                                 
                                    $produit = $produitClient;

                                    $gamme =  $produit->gamme;
                                    $gamme->prix_vente_ht_m2_remise = Gamme::getM2withRemise($produit->gamme_id);
                                    $panier = PanierEdiList::with('panier')->where('id_panier_edi_list','=',$list->id_panier_edi_list)->first();
                                    $produit->prixProduit = Produit::calcul_prix_produit($produit->id_produit);
                                    $produit->gamme = $gamme;
                                    $produit->panier = $panier;
                                    $produit->panierActuel = $panierGet;
                                    $produit->isInPanier = true;
                                    $produit->quantiter = $list->quantiter;
                                    $produit->id_panier_edi_list = $list->id_panier_edi_list;
                                    array_push($produits,$produit);
                                }

                                if(count($panierList) == 0){
                                    $allPanierValide = false;
                                }
                                
                                $validator = Validator::make([
                                    'nom' => $clientList[$i]->nom,
                                    'prenom' => $clientList[$i]->prenom,
                                    'email' => $clientList[$i]->email,
                                    'tel' => $clientList[$i]->tel,
                                    'nom_adresse' => $clientList[$i]->nom_adresse,
                                    'adresse1' => $clientList[$i]->adresse1,
                                    'adresse2' => $clientList[$i]->adresse2,
                                    'adresse3' => $clientList[$i]->adresse3,
                                    'pays' => $clientList[$i]->pays,
                                    'code_postal' => $clientList[$i]->code_postal,
                                    'ville' => $clientList[$i]->ville,
                                ], [
                                    'nom' => 'required|string|max:255',
                                    'prenom' => 'required|string|max:255',
                                    'email' => 'required|string|email|max:255',
                                    'tel' => 'required|numeric|phone:AUTO,FR',
                                    'nom_adresse' => 'required|string|max:255',
                                    'adresse1' => 'required|string|max:32',
                                    'adresse2' => 'nullable|string|max:32',
                                    'adresse3' => 'nullable|string|max:32',
                                    'pays' => 'required|country_name',
                                    'code_postal' => 'required|postal_code:pays',
                                    'ville' => 'required|string|max:32',
                                ]);

                                if ($validator->fails()) {
                                    $clientList[$i]->adresseValide = false;
                                    $allAddValide = false;
                                }else{
                                    $clientList[$i]->adresseValide = true;
                                }

                                $produitsAchat->clients[$i] = ["client"=>$clientList[$i],"produits" => $produits,'nbProduit' => $panierCount];
                                if ($request->session()->has('client_actuel')) {
                                    $client = $request->session()->get('client_actuel');
                                }else{
                                    $client = new \stdClass;
                                }
                                $produitsAchat->clientActuel = $client; 
                            } 
                            $produitsAchat->addresses_valid = $allAddValide;
                            $produitsAchat->panier_valid = $allPanierValide;
                        }


                    }
                }
                return ['count' => $panierCountF,'panier' => $produitsAchat];
            },
            'gammeList' => function() use($request) {
                $gammeList = '';
                if($request->session()->has('gammeList')){
                    $gammeList = $request->session()->get('gammeList');
                    if(empty($gammeList) || count($gammeList) == 0){
                        $gammeList = Gamme::where('gamme.in_edi', '=', '1')->where('gamme.statut', '=', '1')->orderBy('nom_gamme', 'asc')->get();
                    }
                }else{
                    $gammeList = Gamme::where('gamme.in_edi', '=', '1')->where('gamme.statut', '=', '1')->orderBy('nom_gamme', 'asc')->get();
                }
                return $gammeList;
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
