<?php

namespace App\Http\Controllers;

use App\Imports\CommandeImport;
use App\Models\Produit;
use App\Models\ClientEDI;
use App\Models\Design;
use App\Models\Dimension;
use App\Models\Facture;
use App\Models\Gamme;
use App\Models\PanierEdi;
use App\Models\PanierEdiList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\QueryBuilder;

class OrderEntrepotController extends Controller
{

    public function create_type_vente(Request $request){
        $request->session()->put('typeVente', 1);
        return redirect('/order_entrepot/gamme');
    }

    public function create_type_vente_choix_gamme(Request $request){
        $request->session()->put('typeVente', 1);
        return redirect('/order_entrepot/gamme/'.$request->gamme);
    }

    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {

        $gammeSearch = AllowedFilter::callback('nom_gamme', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('gamme.nom_gamme', 'LIKE', "%{$value}%");
                });
            });
        });

        $products = Gamme::getRequestGammeCaracteristiques()
            ->defaultSort('gamme.nom_gamme')
            ->where('gamme.statut', '=', 1)
            ->allowedFilters([$gammeSearch])
            ->paginate((request('perPage') != "" ? request('perPage') : '12'))
            ->withQueryString();

        
        
        $dimensions = Gamme::getAllDimensionGamme(); 
        $products = Gamme::setRemiseGamme($products); 

        return Inertia::render('Auth/Pages/Products', [
            'products' => $products,
            'dimensions' => $dimensions
        ]);
    }

    public function create_post()
    {

        $gammeSearch = AllowedFilter::callback('nom_gamme', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('gamme.nom_gamme', 'LIKE', "%{$value}%");
                });
            });
        });


        $products = Gamme::getRequestGammeCaracteristiques()
            ->defaultSort('gamme.nom_gamme')
            ->where('gamme.statut', '=', 1)
            ->allowedFilters([$gammeSearch])
            ->paginate((request('perPage') != "" ? request('perPage') : '12'))
            ->withQueryString();

            $products->each(function($product, $user){
                $remise = 0;
                if(isset($product->remiseGamme)){
                    $remise = $product->remiseGamme;
                }
                elseif(isset($user->taux_remise)){
                    $remise = $user->taux_remise;
                }
 
                if($remise > 0){
                    $product->prix_vente_ht_m2_remise = "".round($product->prix_vente_ht_m2 * (1 - ($remise / 100)), 2) . "";
                }
                else{
                    $product->prix_vente_ht_m2_remise = false;
                }
            });

        return [
            'products' => $products
        ];
    }

    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create_product($gamme,Request $request)
    {
        $gammeSearch = Gamme::where('nom_gamme', '=', $gamme)->first();
        $gammeSearch = Gamme::getGammeCaracteristiques($gammeSearch->id_gamme);

        $designpanier = Produit::getAllCaracteristiquesDesign()
            ->distinct()
            ->join('gamme', 'gamme.id_gamme', 'produit.gamme_id')
            ->join('gammes_features as sp', function ($join) {
                $join->on('gamme.id_gamme', '=', 'sp.gamme_id')
                    ->where('sp.feature_id', '=', 13)
                    ->where('sp.data_values', 'LIKE', '%Oui%');
            })
            ->where('gamme.statut', '=', '1')
            ->where('produit.code_sku', '!=', 'null')
            ->where('produit.code_sku', '!=', '""')
            ->where('produit.drop_shipping', '=', '1')
            ->where('produit.statut', '=', '1')
            ->where('gamme.nom_gamme', '=', $gamme)
            ->get();


        if ($request->session()->has('client_commercial')) {
            $clientUser = $request->session()->get('client_commercial');
        } else {
            $clientUser = array();
        }

        for ($i = 0; $i < count($designpanier); $i++) {
            $produits = Produit::getAllCaracteristiques()
            ->with(['statsProduit','photo' => function($query) {
                $query->where('principale', '=', '1');
            }])
            ->where('produit.design','=',$designpanier[$i]->design)->get();
            for ($j = 0; $j < count($produits); $j++) {
                if($produits[$j]->photo != null){
                    $designpanier[$i]->img_produit = ($produits[$j]->photo != null && $produits[$j]->photo->img_produit != null ? $produits[$j]->photo->img_produit : '');
                }else if(!isset($designpanier[$i]->img_produit)){
                    $designpanier[$i]->img_produit = '';
                }
                
                if(!empty($clientUser)){
                    if (PanierEdiList::where('id_produit', '=', $produits[$j]->id_produit)->where('id_client_edi', '=', $clientUser->id_client_edi)->exists()) {
                        $panier = PanierEdiList::where('id_produit', '=', $produits[$j]->id_produit)->where('id_client_edi', '=', $clientUser->id_client_edi)->first();
                        $produits[$j]->produit_panier = $panier;
                        $produits[$j]->isInPanier = true;
                    } else {
                        $produits[$j]->produit_panier = array("quantiter" => 0);
                        $produits[$j]->isInPanier = false;
                    }
                }else{
                    $produits[$j]->produit_panier = array("quantiter" => 0);
                    $produits[$j]->isInPanier = false;
                }
                $produits[$j]->prixProduit = Produit::calcul_prix_produit($produits[$j]->id_produit,0);
            }
            $designpanier[$i]->produits = $produits;
        }
        if ($request->isMethod('post')) {
            return [
                'gamme' => $gammeSearch,
                'designpanier' => $designpanier
            ];
        }else{
            return Inertia::render('Auth/Pages/Products/Gamme', [
                'gamme' => $gammeSearch,
                'designpanier' => $designpanier
            ]);
        }
    }

    /**
     * Ajoute le produit au panier de l'utilisateur
     */
    public function add_product_commande(Request $request)
    {
        $message ='';
        if (!$request->session()->has('panier_commercial')) {
            $num_commande = PanierEdi::generateNumOrder();
            $panier = PanierEdi::create([
                'date_ajout' => date('Y-m-d H:i:s'),
                'date_maj' => date('Y-m-d H:i:s'),
                'date_commande' => date('Y-m-d'),
                'num_commande' => $num_commande,
                'nb_client' => '1',
                'total_HT' => '0',
                'total_taxe' => '0',
                'total_ttc' => '0',
                'total_payer' => '0',
                'poids_total' => '0',
                'total_m2' => '0',
                'produits_total' => '0',
                'total_payer' => '0',
                'is_validate' => '0',
                'is_marketplace' => '0',
                'id_etape' => '1',
                'id_users' => Auth::user()->getAuthIdentifier(),
            ]);

            if (isset($panier->id_panier_edi) && !empty($panier->id_panier_edi)) {
                $user = User::with(['client'])->find(Auth::user()->getAuthIdentifier())->first();
                if (isset($user->id) && !empty($user->id) && isset($user->client->id_client) && !empty($user->client->id_client)) {
                    $num_commande = ClientEdi::genNumCommande($panier->id_panier_edi);
                    $contact = explode(' ', $user->client->contact);
                    if (count($contact) > 1) {
                        $nom = $contact[1];
                        $prenom = $contact[0];
                    } else {
                        $nom = $contact[0];
                        $prenom = '';
                    }
                    $client = ClientEDI::create([
                        'date_ajout' => date('Y-m-d H:i:s'),
                        'date_maj' => date('Y-m-d H:i:s'),
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'email' => $user->client->email,
                        'tel' => $user->client->tel1,
                        'date_commande' => date('Y-m-d'),
                        'nom_adresse' => $user->client->contact,
                        'adresse1' => $user->client->adresse1,
                        'adresse2' => $user->client->adresse2,
                        'adresse3' => $user->client->adresse3,
                        'pays' => $user->client->pays,
                        'code_postal' => $user->client->code_postal,
                        'ville' => $user->client->ville,
                        'nom_adresse_facturation' => $user->client->contact,
                        'adresse1_facturation' => $user->client->adresse1,
                        'adresse2_facturation' => $user->client->adresse2,
                        'adresse3_facturation' => $user->client->adresse3,
                        'pays_facturation' => $user->client->pays,
                        'code_postal_facturation' => $user->client->code_postal,
                        'ville_facturation' => $user->client->ville,
                        'num_commande' => $num_commande,
                        'quantiter' => 0,
                        'poids' => 0,
                        'total_ht' => 0,
                        'total_taxe' => 0,
                        'total_ttc' => 0,
                        'total_m2' => 0,
                        'id_panier_edi' => $panier->id_panier_edi
                    ]);
                    $clientGet = ClientEDI::with('panier')->where('id_client_edi', '=', $client->id_client_edi)->first();
                    $request->session()->put('client_commercial', $clientGet);
                } else {
                    $client = '';
                }
            } else {
                $client = '';
            }
        } else {
            $panier = $request->session()->get('panier_commercial');
        }
        

        if ($request->session()->has('client_commercial')) {
            $client = $request->session()->get('client_commercial');
        } else {
            $client = '';
        }
        $status = false;
        $id_panier_edi_list = 0;
        if (!$panier->is_validate && !empty($request->idProduit) && !empty($request->quantiter) && !empty($client)) {
            if (isset($request->id_panier_edi_list) && !empty($request->id_panier_edi_list) && $request->id_panier_edi_list > 0) {
                $panierList = PanierEdiList::where('id_panier_edi_list', '=', $request->id_panier_edi_list)->first();
                if (isset($panierList->id_panier_edi_list) && !empty($panierList->id_panier_edi_list)) {
                    $prix_TTC_TT = round($panierList->prix_ttc_unitaire * $request->quantiter,2);
                    $prix_HT_TT = round($prix_TTC_TT / 1.2,2);
                    $prix_TVA_TT = round($prix_TTC_TT - $prix_HT_TT,2);
                     $panierList->quantiter = $request->quantiter;
                     $panierList->prix_ttc_total = $prix_TTC_TT;
                     $panierList->prix_taxe_total = $prix_TVA_TT;
                     $panierList->prix_ht_total = $prix_HT_TT;
                    $panierList->save();
                    PanierEdi::calculPrixPanier($client->id_panier_edi);
                    ClientEDI::calculPrixPanier($client->id_client_edi);
                    $status = true;
                    $id_panier_edi_list = $panierList->id_panier_edi_list;
                }
            } else {
                $produit = Produit::where('id_produit', '=', $request->idProduit)->first();
                if (!empty($produit->id_produit)) {
                    $prix_produit =  round(round(Produit::calcul_prix_produit($produit->id_produit,1),3),2);
                    $prix_ht = round($prix_produit / 1.2,2); 
                    $prix_TVA = round($prix_produit - $prix_ht,2);
                     
                    $prix_TTC_TT = round($prix_produit * $request->quantiter,2);
                    $prix_HT_TT = round($prix_TTC_TT / 1.2,2);
                    $prix_TVA_TT = round($prix_TTC_TT - $prix_HT_TT,2);
                     
                    $addProducts = PanierEdiList::create([
                        'date_ajout' => date('Y-m-d H:i:s'),
                        'date_maj' => date('Y-m-d H:i:s'),
                        'id_produit' => $request->idProduit,
                        'prix_ht_unitaire' => $prix_ht,
                        'prix_taxe_unitaire' => $prix_TVA,
                        'prix_ttc_unitaire' => $prix_produit,
                        'quantiter' => $request->quantiter,
                        'prix_ht_total' => $prix_HT_TT,
                        'prix_taxe_total' => $prix_TVA_TT,
                        'prix_ttc_total' => $prix_TTC_TT,
                        'id_client_edi' => $client->id_client_edi,
                    ]);

                    $id_panier_edi_list = $addProducts->id_panier_edi_list;

                    if (isset($addProducts->id_panier_edi_list) && !empty($addProducts->id_panier_edi_list)) {
                        PanierEdi::calculPrixPanier($client->id_panier_edi);
                        ClientEDI::calculPrixPanier($client->id_client_edi);
                        $status = true;
                    }
                }
            }
        }else{
            if($panier->is_validate){
                $message = "Votre panier a déjà été valider, vous pouvez aller dans Expéditions pour voir les détails de votre commande.";
            }else{
                $message = "Une erreur c'est produit lors de l'ajout du produit."; 
            }
        }
        $panierGet = PanierEdi::with(['client_edi_list'])->where('id_panier_edi', '=', $panier->id_panier_edi)->first();
        $request->session()->put('panier_commercial', $panierGet);
        return redirect()->back()->with(['status' => $status, 'id_panier_edi_list' => $id_panier_edi_list, 'message' => $message]);
    }

    /**
     * Suprimme le produit de la commande du client
     */
    public function delete_product_commande(Request $request) {
        $status = false;
        $message = '';
        if(!empty($request->id_panier_edi_list) && !empty($request->id_panier_edi_list) && $request->id_panier_edi_list > 0){
           $panierList = PanierEdiList::where('id_panier_edi_list','=',$request->id_panier_edi_list)->first();
           if(isset($panierList->id_panier_edi_list) && !empty($panierList->id_panier_edi_list)){
             $client = ClientEDI::where('id_client_edi','=',$panierList->id_client_edi)->first();  
             $panier = PanierEdi::with(['client_edi_list'])->where('id_panier_edi', '=', $client->id_panier_edi)->first();  
            if(!$panier->is_validate){
                $panierList->forceDelete();
                PanierEdi::calculPrixPanier($client->id_panier_edi);
                ClientEDI::calculPrixPanier($client->id_client_edi);
                $panierGet = PanierEdi::with(['client_edi_list'])->where('id_panier_edi', '=', $client->id_panier_edi)->first();
                $request->session()->put('panier_commercial', $panierGet);
                $status = true;
            }else{
                if($panier->is_validate){
                    $message = "Votre panier a déjà été valider, vous pouvez aller dans Expéditions pour voir les détails de votre commande.";
                }else{
                    $message = "Une erreur c'est produit lors de la supression du produit du panier"; 
                }
            }
           }
        }
  
        return redirect()->back()->with(['status'=>$status,'message' => $message]);
    }

    public function import_panier_commande(Request $request)
    {
        $request->validate(['fileImport' => 'required|file|mimes:xls,xlsx']);

        $imports = Excel::import(new CommandeImport, $request->file('fileImport')->store('temp'))->toCollection(new CommandeImport, $request->file('fileImport')->store('temp'));

        if (!$request->session()->has('panier_commercial')) {
            $num_commande = PanierEdi::generateNumOrder();
            $panier = PanierEdi::create([
                'date_ajout' => date('Y-m-d H:i:s'),
                'date_maj' => date('Y-m-d H:i:s'),
                'date_commande' => date('Y-m-d'),
                'num_commande' => $num_commande,
                'nb_client' => '1',
                'total_HT' => '0',
                'total_taxe' => '0',
                'total_ttc' => '0',
                'total_payer' => '0',
                'poids_total' => '0',
                'total_m2' => '0',
                'produits_total' => '0',
                'total_payer' => '0',
                'is_validate' => '0',
                'is_marketplace' => '0',
                'id_etape' => '1',
                'id_users' => Auth::user()->getAuthIdentifier(),
            ]);

            if (isset($panier->id_panier_edi) && !empty($panier->id_panier_edi)) {
                $user = User::with(['client'])->find(Auth::user()->getAuthIdentifier())->first();
                if (isset($user->id) && !empty($user->id) && isset($user->client->id_client) && !empty($user->client->id_client)) {
                    $num_commande = ClientEdi::genNumCommande($panier->id_panier_edi);
                    $contact = explode(' ', $user->client->contact);
                    if (count($contact) > 1) {
                        $nom = $contact[1];
                        $prenom = $contact[0];
                    } else {
                        $nom = $contact[0];
                        $prenom = '';
                    }
                    $client = ClientEDI::create([
                        'date_ajout' => date('Y-m-d H:i:s'),
                        'date_maj' => date('Y-m-d H:i:s'),
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'email' => $user->client->email,
                        'tel' => $user->client->tel1,
                        'date_commande' => date('Y-m-d'),
                        'nom_adresse' => $user->client->contact,
                        'adresse1' => $user->client->adresse1,
                        'adresse2' => $user->client->adresse2,
                        'adresse3' => $user->client->adresse3,
                        'pays' => $user->client->pays,
                        'code_postal' => $user->client->code_postal,
                        'ville' => $user->client->ville,
                        'nom_adresse_facturation' => $user->client->contact,
                        'adresse1_facturation' => $user->client->adresse1,
                        'adresse2_facturation' => $user->client->adresse2,
                        'adresse3_facturation' => $user->client->adresse3,
                        'pays_facturation' => $user->client->pays,
                        'code_postal_facturation' => $user->client->code_postal,
                        'ville_facturation' => $user->client->ville,
                        'num_commande' => $num_commande,
                        'quantiter' => 0,
                        'poids' => 0,
                        'total_ht' => 0,
                        'total_taxe' => 0,
                        'total_ttc' => 0,
                        'total_m2' => 0,
                        'id_panier_edi' => $panier->id_panier_edi
                    ]);
                    $clientGet = ClientEDI::with('panier')->where('id_client_edi', '=', $client->id_client_edi)->first();
                    $request->session()->put('client_commercial', $clientGet);
                } else {
                    $client = '';
                }
            } else {
                $client = '';
            }
        } else {
            $panier = $request->session()->get('panier_commercial');
        }

        if ($request->session()->has('client_commercial')) {
            $client = $request->session()->get('client_commercial');
        } else {
            $client = '';
        }

        $stock_error = false;

        foreach ($imports[0] as $import) {
            $eanProduct = $import['ean_product'];
            $qte = $import['qte'];
            $product = Produit::with(['statsProduit'])->where('gencode', '=', $eanProduct)->first();
            if (isset($product->id_produit) && !empty($product->id_produit)) {
                if (!empty($client)) {
                    $search = PanierEdiList::where('id_produit','=',$product->id_produit)->where('id_client_edi','=',$client->id_client_edi)->first();
                    if(!empty($search->id_panier_edi_list)){
                        $addProducts = $search;
                        if($product->statsProduit->stock_restant >= ($addProducts->quantiter + $qte)){
                            $addProducts->quantiter = $addProducts->quantiter + $qte;
                            $prix_TTC_TT = round($addProducts->prix_ttc_unitaire * $addProducts->quantiter,2);
                            $prix_TVA_TT = round($prix_TTC_TT * 0.2,2);
                            $prix_HT_TT = $prix_TTC_TT - $prix_TVA_TT;
                            $addProducts->prix_ttc_total = $prix_TTC_TT;
                            $addProducts->prix_taxe_total = $prix_TVA_TT;
                            $addProducts->prix_ht_total = $prix_HT_TT;
                            
                            $addProducts->save();
                        }else{
                            $stock_error = true;
                        }
                    }else{
                        if($product->statsProduit->stock_restant >= $qte){
                            $prix_produit =  round(Produit::calcul_prix_produit($product->id_produit),2);
                            $prix_TVA = round($prix_produit * 0.2,2);
                            $prix_ht = $prix_produit - $prix_TVA;
                            $prix_TTC_TT = round($prix_produit * $qte,2);
                            $prix_TVA_TT = round($prix_TTC_TT * 0.2,2);
                            $prix_HT_TT = $prix_TTC_TT - $prix_TVA_TT;
                            $addProducts = PanierEdiList::create([
                                'date_ajout' => date('Y-m-d H:i:s'),
                                'date_maj' => date('Y-m-d H:i:s'),
                                'id_produit' => $product->id_produit,
                                'prix_ht_unitaire' => $prix_ht,
                                'prix_taxe_unitaire' => $prix_TVA,
                                'prix_ttc_unitaire' => $prix_produit,
                                'quantiter' => $qte,
                                'prix_ht_total' => $prix_HT_TT,
                                'prix_taxe_total' => $prix_TVA_TT,
                                'prix_ttc_total' => $prix_TTC_TT,
                                'id_client_edi' => $client->id_client_edi,
                            ]);
                        }else{
                            $stock_error = true;
                        }
                    }

                    if (isset($addProducts->id_panier_edi_list) && !empty($addProducts->id_panier_edi_list)) {
                        PanierEdi::calculPrixPanier($client->id_panier_edi);
                        ClientEDI::calculPrixPanier($client->id_client_edi);
                    }
                }
            }
        }

        $panierGet = PanierEdi::with(['client_edi_list'])->where('id_panier_edi', '=', $panier->id_panier_edi)->first();
        $request->session()->put('panier_commercial', $panierGet);
        if($stock_error == 1){
            return redirect('/cart/error/import_stock');
        }else{
            return redirect('/cart');
        }
       
    }
}
