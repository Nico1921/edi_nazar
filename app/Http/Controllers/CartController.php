<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use App\Models\AdresseMarketplace;
use App\Models\ClientMarketplace;
use App\Models\CommandeMarketplace;
use App\Models\CommandeMarketplaceList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ClientEDI;
use App\Models\Commande;
use App\Models\CommandeList;
use App\Models\PanierEdi;
use App\Models\Gamme;
use App\Models\Produit;
use App\Models\PanierEdiList;
use App\Models\StatsProduit;
use App\Models\TransactionPaiement;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Sebastienheyd\Systempay\Systempay;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        if($request->session()->has('panier_commercial')){
            $panierCom = $request->session()->get('panier_commercial');
        }else{
            $panierCom = array();
        }

        return Inertia::render('Auth/Pages/Cart',['panier' => $panierCom]);
    }

    public function edit_qte(Request $request){
        $status = false;
        $message = 'Une erreur c\'est produit lors de la modification de la quantiter du produit.';
        $id_panier_edi_list = 0;
        if (!empty($request->idProduit) && !empty($request->quantiter) && !empty($request->id_panier_edi) && !empty($request->id_client_edi)) {
            $stock = StatsProduit::where('id_produit','=',$request->idProduit)->first();
            if(isset($stock->stock_restant) && $stock->stock_restant > $request->quantiter) {
                if (isset($request->id_panier_edi_list) && !empty($request->id_panier_edi_list) && $request->id_panier_edi_list > 0) {
                    $panierList = PanierEdiList::where('id_panier_edi_list', '=', $request->id_panier_edi_list)->first();
                    if (isset($panierList->id_panier_edi_list) && !empty($panierList->id_panier_edi_list)) {
                        $prix_TTC_TT = round($panierList->prix_ttc_unitaire * $request->quantiter,2);
                        $prix_HT_TT = round($prix_TTC_TT / 1.2,2);;
                        $prix_TVA_TT = round($prix_TTC_TT - $prix_HT_TT,2);
                        $panierList->quantiter = $request->quantiter;
                        $panierList->prix_ttc_total = $prix_TTC_TT;
                        $panierList->prix_taxe_total = $prix_TVA_TT;
                        $panierList->prix_ht_total = $prix_HT_TT;
                        $panierList->save();
                        PanierEdi::calculPrixPanier($request->id_panier_edi);
                        ClientEDI::calculPrixPanier($request->id_client_edi);
                        $status = true;
                        $id_panier_edi_list = $panierList->id_panier_edi_list;
                    }
                } 
            }else{
                $message = 'La quantiter demander ne peux être fournis pour le moment, notre stock n\'est pas suffisant.';
            }
        }
        $panierGet = PanierEdi::with(['client_edi_list'])->where('id_panier_edi', '=', $request->id_panier_edi)->first();
        $request->session()->put('panier_commercial', $panierGet);
        return redirect()->back()->with(['status' => $status,'message' => $message, 'id_panier_edi_list' => $id_panier_edi_list]);
    }

    public function edit_qte_drop(Request $request){
        $status = false;
        $message = 'Une erreur c\'est produit lors de la modification de la quantiter du produit.';
        $id_panier_edi_list = 0;
        if (!empty($request->idProduit) && !empty($request->quantiter) && !empty($request->id_panier_edi) && !empty($request->id_client_edi)) {
            $stock = StatsProduit::where('id_produit','=',$request->idProduit)->first();
            if(isset($stock->stock_restant) && $stock->stock_restant > $request->quantiter) {
                if (isset($request->id_panier_edi_list) && !empty($request->id_panier_edi_list) && $request->id_panier_edi_list > 0) {
                    $panierList = PanierEdiList::where('id_panier_edi_list', '=', $request->id_panier_edi_list)->first();
                    if (isset($panierList->id_panier_edi_list) && !empty($panierList->id_panier_edi_list)) {
                        $prix_TTC_TT = round($panierList->prix_ttc_unitaire * $request->quantiter,2);
                        $prix_HT_TT = round($prix_TTC_TT / 1.2,2);;
                        $prix_TVA_TT = round($prix_TTC_TT - $prix_HT_TT,2);
                        $panierList->quantiter = $request->quantiter;
                        $panierList->prix_ttc_total = $prix_TTC_TT;
                        $panierList->prix_taxe_total = $prix_TVA_TT;
                        $panierList->prix_ht_total = $prix_HT_TT;
                        $panierList->save();
                        PanierEdi::calculPrixPanier($request->id_panier_edi);
                        ClientEDI::calculPrixPanier($request->id_client_edi);
                        $status = true;
                        $id_panier_edi_list = $panierList->id_panier_edi_list;
                    }
                } 
            }else{
                $message = 'La quantiter demander ne peux être fournis pour le moment, notre stock n\'est pas suffisant.';
            }
        }
        $panierGet = PanierEdi::with(['client_edi_list'])->where('id_panier_edi', '=', $request->id_panier_edi)->first();
        $request->session()->put('panier_mkp', $panierGet);
        return redirect()->back()->with(['status' => $status,'message' => $message, 'id_panier_edi_list' => $id_panier_edi_list]);
    }

    public function delete_card_product(Request $request)
    {
        $status = false;
        if(!empty($request->id_panier_edi_list) && !empty($request->id_panier_edi_list) && $request->id_panier_edi_list > 0){
           $panierList = PanierEdiList::where('id_panier_edi_list','=',$request->id_panier_edi_list)->first();
           if(isset($panierList->id_panier_edi_list) && !empty($panierList->id_panier_edi_list)){
              $client = ClientEDI::where('id_client_edi','=',$panierList->id_client_edi)->first();
              $panierList->forceDelete();
              PanierEdi::calculPrixPanier($client->id_panier_edi);
              ClientEDI::calculPrixPanier($client->id_client_edi);
              $panierGet = PanierEdi::with(['client_edi_list'])->where('id_panier_edi', '=', $client->id_panier_edi)->first();
              $request->session()->put('panier_commercial', $panierGet);
              $status = true;
           }
        }

        return redirect()->back()->with(['status'=>$status]);
    }

    public function delete_card_product_drop(Request $request)
    {
        $status = false;
        if(!empty($request->id_panier_edi_list) && !empty($request->id_panier_edi_list) && $request->id_panier_edi_list > 0){
           $panierList = PanierEdiList::where('id_panier_edi_list','=',$request->id_panier_edi_list)->first();
           if(isset($panierList->id_panier_edi_list) && !empty($panierList->id_panier_edi_list)){
              $client = ClientEDI::where('id_client_edi','=',$panierList->id_client_edi)->first();
              $panierList->forceDelete();
              PanierEdi::calculPrixPanier($client->id_panier_edi);
              ClientEDI::calculPrixPanier($client->id_client_edi);
              $panierGet = PanierEdi::with(['client_edi_list'])->where('id_panier_edi', '=', $client->id_panier_edi)->first();
              $request->session()->put('panier_mkp', $panierGet);
              $status = true;
           }
        }

        return redirect()->back()->with(['status'=>$status]);
    }

    /**
     * Suprimme la commande du client
     */
    public function delete_order_client_drop(Request $request)
    {
        $status = false;
        if(!empty($request->id_client_edi) && !empty($request->id_client_edi) && $request->id_client_edi > 0){
           $clientEdi = ClientEDI::where('id_client_edi','=',$request->id_client_edi)->first();
           if(isset($clientEdi->id_client_edi) && !empty($clientEdi->id_client_edi)){
              PanierEdiList::where('id_client_edi','=',$clientEdi->id_client_edi)->forceDelete();
              ClientEDI::where('id_client_edi','=',$request->id_client_edi)->forceDelete();
              PanierEdi::calculPrixPanier($request->id_panier_edi);
              $clientGet = ClientEDI::where('id_panier_edi','=',$request->id_panier_edi)->first();
              $panierGet = PanierEdi::with('client_edi_list')->where('id_panier_edi','=',$request->id_panier_edi)->first();
              $request->session()->put('panier_mkp',$panierGet);
              $request->session()->put('client_actuel',$clientGet);
              $status = true;
           }
        }
  
        return redirect()->back()->with(['status'=>$status]);
    }

    public function add_adresse_commande_drop(Request $request){
        $status = false;
        $validation = array();
        if(isset($request->sameAdresseFact) && $request->sameAdresseFact){
            $validation = [
                'id_client_edi' => 'required|int',
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
            ];
        }else{
            $validation = [
                'id_client_edi' => 'required|int',
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'tel' => 'required|numeric|phone:AUTO,FR',
                'nom_adresse' => 'required |string|max:255',
                'adresse1' => 'required|string|max:32',
                'adresse2' => 'nullable|string|max:32',
                'adresse3' => 'nullable|string|max:32',
                'pays' => 'required|country_name',
                'code_postal' => 'required|postal_code:pays',
                'ville' => 'required|string|max:32',
                'nom_adresse_facturation' => 'required|string|max:255',
                'adresse1_facturation' => 'required|string|max:32',
                'adresse2_facturation' => 'nullable|string|max:32',
                'adresse3_facturation' => 'nullable|string|max:32',
                'pays_facturation' => 'required|country_name',
                'code_postal_facturation' => 'required|postal_code:pays',
                'ville_facturation' => 'required|string|max:32',
            ];
        }
        $request->validate($validation);
        if(isset($request->id_client_edi) && $request->id_client_edi > 0){
            $clientEDI = ClientEDI::where('id_client_edi','=',$request->id_client_edi)->first();
            if(isset($clientEDI->id_client_edi) && !empty($clientEDI->id_client_edi)){
                $clientEDI->nom = $request->nom;
                $clientEDI->prenom = $request->prenom;
                $clientEDI->email = $request->email;
                $clientEDI->tel = $request->tel;
                $clientEDI->nom_adresse = $request->nom_adresse;
                $clientEDI->adresse1 = $request->adresse1;
                $clientEDI->adresse2 = $request->adresse2;
                $clientEDI->adresse3 = $request->adresse3;
                $clientEDI->pays = $request->pays;
                $clientEDI->code_postal = $request->code_postal;
                $clientEDI->ville = $request->ville;
                if(isset($request->sameAdresseFact) && !$request->sameAdresseFact){
                    $clientEDI->nom_adresse_facturation = $request->nom_adresse_facturation;
                    $clientEDI->adresse1_facturation = $request->adresse1_facturation;
                    $clientEDI->adresse2_facturation = $request->adresse2_facturation;
                    $clientEDI->adresse3_facturation = $request->adresse3_facturation;
                    $clientEDI->pays_facturation = $request->pays_facturation;
                    $clientEDI->code_postal_facturation = $request->code_postal_facturation;
                    $clientEDI->ville_facturation = $request->ville_facturation;
                }else{
                    $clientEDI->nom_adresse_facturation = $request->nom_adresse;
                    $clientEDI->adresse1_facturation = $request->adresse1;
                    $clientEDI->adresse2_facturation = $request->adresse2;
                    $clientEDI->adresse3_facturation = $request->adresse3;
                    $clientEDI->pays_facturation = $request->pays;
                    $clientEDI->code_postal_facturation = $request->code_postal;
                    $clientEDI->ville_facturation = $request->ville;
                }
    
                $clientEDI->save();
                $clientGet = ClientEDI::where('id_client_edi','=',$request->id_client_edi)->first();
                $panierGet = PanierEdi::with('client_edi_list')->where('id_panier_edi','=',$clientGet->id_panier_edi)->first();
                $request->session()->put('panier_mkp',$panierGet);
                $request->session()->put('client_actuel',$clientGet);
                $status = true;
            }
        }

        return redirect()->back()->with(['status'=>$status]);
    }

    public function create_adresses_validation_drop(Request $request) {
        $panier = array();
        if($request->session()->has('panier_mkp')){
            $panier = $request->session()->get('panier_mkp');
            $id_client_edi = $panier->client_edi_list[0]->id_client_edi;
            if(empty($id_client_edi)){
                return Redirect::route('dropshipping/cart');
            }else{
                $isvalid = true;
                $isvalidAdresse = true;
                foreach($panier->client_edi_list as $client){
                    if($client->quantiter == 0 ){
                        $isvalid = false;
                    }

                    $validator = Validator::make([
                        'nom' => $client->nom,
                        'prenom' => $client->prenom,
                        'email' => $client->email,
                        'tel' => $client->tel,
                        'nom_adresse' => $client->nom_adresse,
                        'adresse1' => $client->adresse1,
                        'adresse2' => $client->adresse2,
                        'adresse3' => $client->adresse3,
                        'pays' => $client->pays,
                        'code_postal' => $client->code_postal,
                        'ville' => $client->ville,
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
                        $isvalidAdresse = false;
                    }
                }
                if(!$isvalid){
                    return Redirect::route('dropshipping/cart');
                }else if(!$isvalidAdresse){
                    return Redirect::route('dropshipping/cart/adresses');
                }
            }
        }else{
            return Redirect::route('dropshipping/cart');
        }

        return Inertia::render('Auth/Pages/Cart/ValidationDrop',['panier' => $panier]);
    }

    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create_adresses(Request $request)
    {
        if($request->session()->has('panier_commercial') && $request->session()->has('client_commercial')){
            $panierCom = $request->session()->get('panier_commercial');
            $clientEDI =  $request->session()->get('client_commercial');
        }else{
            $panierCom = array();
            $clientEDI = array();
            return Redirect::route('cart');
        }

        return Inertia::render('Auth/Pages/Cart/Adresses',['panier' => $panierCom, 'client' => $clientEDI]);
    }

    public function add_adresse_commande(Request $request){
        $status = false;
        $validation = array();
        if(isset($request->sameAdresseFact) && $request->sameAdresseFact){
            $validation = [
                'email' => 'required|string|email|max:255',
                'tel' => 'required|numeric|phone:AUTO,FR',
                'nom_adresse' => 'required|string|max:255',
                'adresse1' => 'required|string|max:32',
                'adresse2' => 'nullable|string|max:32',
                'adresse3' => 'nullable|string|max:32',
                'pays' => 'required|country_name',
                'code_postal' => 'required|postal_code:pays',
                'ville' => 'required|string|max:32',
            ];
        }else{
            $validation = [
                'email' => 'required|string|email|max:255',
                'tel' => 'required|numeric|phone:AUTO,FR',
                'nom_adresse' => 'required|string|max:255',
                'adresse1' => 'required|string|max:32',
                'adresse2' => 'nullable|string|max:32',
                'adresse3' => 'nullable|string|max:32',
                'pays' => 'required|country_name',
                'code_postal' => 'required|postal_code:pays',
                'ville' => 'required|string|max:32',
                'nom_adresse_facturation' => 'required|string|max:255',
                'adresse1_facturation' => 'required|string|max:32',
                'adresse2_facturation' => 'nullable|string|max:32',
                'adresse3_facturation' => 'nullable|string|max:32',
                'pays_facturation' => 'required|country_name',
                'code_postal_facturation' => 'required|postal_code:pays',
                'ville_facturation' => 'required|string|max:32',
            ];
        }
        $request->validate($validation);
        if($request->session()->has('client_commercial')){
            $clientSession = $request->session()->get('client_commercial');
            $clientEDI = ClientEDI::where('id_client_edi','=',$clientSession->id_client_edi)->first();
            if(isset($clientEDI->id_client_edi) && !empty($clientEDI->id_client_edi)){
                $clientEDI->email = $request->email;
                $clientEDI->tel = $request->tel;
                $clientEDI->nom_adresse = $request->nom_adresse;
                $clientEDI->adresse1 = $request->adresse1;
                $clientEDI->adresse2 = $request->adresse2;
                $clientEDI->adresse3 = $request->adresse3;
                $clientEDI->pays = $request->pays;
                $clientEDI->code_postal = $request->code_postal;
                $clientEDI->ville = $request->ville;
                if(isset($request->sameAdresseFact) && !$request->sameAdresseFact){
                    $clientEDI->nom_adresse_facturation = $request->nom_adresse_facturation;
                    $clientEDI->adresse1_facturation = $request->adresse1_facturation;
                    $clientEDI->adresse2_facturation = $request->adresse2_facturation;
                    $clientEDI->adresse3_facturation = $request->adresse3_facturation;
                    $clientEDI->pays_facturation = $request->pays_facturation;
                    $clientEDI->code_postal_facturation = $request->code_postal_facturation;
                    $clientEDI->ville_facturation = $request->ville_facturation;
                }else{
                    $clientEDI->nom_adresse_facturation = $request->nom_adresse;
                    $clientEDI->adresse1_facturation = $request->adresse1;
                    $clientEDI->adresse2_facturation = $request->adresse2;
                    $clientEDI->adresse3_facturation = $request->adresse3;
                    $clientEDI->pays_facturation = $request->pays;
                    $clientEDI->code_postal_facturation = $request->code_postal;
                    $clientEDI->ville_facturation = $request->ville;
                }
    
                $clientEDI->save();
                $clientGet = ClientEDI::with('panier')->where('id_client_edi', '=', $clientEDI->id_client_edi)->first();
                $request->session()->put('client_commercial', $clientGet);
                $status = true;
            }
        }

        return redirect()->back()->with(['status'=>$status]);
    }

    public function create_adresses_validation(Request $request) {
        $panierCom = array();
        $produits = array();
        $clientEDI = null;
        if($request->session()->has('panier_commercial') && $request->session()->has('client_commercial')){
            $client = $request->session()->get('client_commercial');
            $clientEDI =  $request->session()->get('client_commercial');
            if(!empty($client->adresse1) && !empty($client->ville) && !empty($client->code_postal) && !empty($client->pays) && !empty($client->nom_adresse)){
                $panierCom = $request->session()->get('panier_commercial');
                $id_client_edi = $panierCom->client_edi_list[0]->id_client_edi;
                $produits = new \stdClass;
                if(!empty($id_client_edi)){
                    $validator = Validator::make([
                        'nom' => $panierCom->client_edi_list[0]->nom,
                        'prenom' => $panierCom->client_edi_list[0]->prenom,
                        'email' => $panierCom->client_edi_list[0]->email,
                        'tel' => $panierCom->client_edi_list[0]->tel,
                        'nom_adresse' => $panierCom->client_edi_list[0]->nom_adresse,
                        'adresse1' => $panierCom->client_edi_list[0]->adresse1,
                        'adresse2' => $panierCom->client_edi_list[0]->adresse2,
                        'adresse3' => $panierCom->client_edi_list[0]->adresse3,
                        'pays' => $panierCom->client_edi_list[0]->pays,
                        'code_postal' => $panierCom->client_edi_list[0]->code_postal,
                        'ville' => $panierCom->client_edi_list[0]->ville,
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
                        return Redirect::route('cart');
                    }else{
                        $panierList = PanierEdiList::where('id_client_edi','=',$id_client_edi)->get();
                        foreach($panierList as $list){
                           $produit = Produit::with(['photo','dimension','statsProduit','design'])->where('id_produit','=',$list->id_produit)->get();
                           for($i=0;$i<count($produit);$i++){
                              $gamme = Gamme::where('id_gamme','=',$produit[$i]->design->id_gamme)->first();
                              $panier = PanierEdiList::with('panier')->where('id_panier_edi_list','=',$list->id_panier_edi_list)->first();
                              $produit[$i]->gamme = $gamme;
                              $produit[$i]->panier = $panier;
                              $produit[$i]->isInPanier = true;
                              $produits->panier[] = $produit[$i];
                           }
                        }
                    }
                   
                }else{
                    return Redirect::route('cart');
                }
            }else{
                return Redirect::route('cart');
            }
        }else{
            return Redirect::route('cart');
        }

        return Inertia::render('Auth/Pages/Cart/Validation',['client' => $clientEDI,'panier' => $panierCom, 'produits' => $produits]);
    }

    public function generate_form_payment_cb(Request $request){
        $html = '';
        if($request->session()->has('panier_commercial') && $request->session()->has('client_commercial')){
            $panierCommercial = $request->session()->get('panier_commercial');
            $panier = PanierEdi::where('id_panier_edi','=',$panierCommercial->id_panier_edi)->first();
            if(isset($panier->id_panier_edi) && !empty($panier->id_panier_edi)){
                if($panier->total_ttc > 0){
                    $trans_id = TransactionPaiement::generate_id_transaction();
                    if(!empty($trans_id)){
                        $paiement = new Systempay();
                        $paiement->set([
                            'amount' => $panier->total_ttc,
                            'trans_id' => $trans_id
                        ]);
                        $html = $paiement->render();
                    }else{
                        return ['statut' => false,'msg' => 'Une erreur est survenue, veuillez ressayer plus tard !'];
                    }     
                }else{
                    return ['statut' => false,'msg' => 'Une erreur est survenue, vérifier que votre panier n\'est pas vide ou que vous êtes encore connecté !'];
                }
            }else{
                return ['statut' => false,'msg' => 'Une erreur est survenue lors de la génération du formulaire de paiement, vérifier que vous êtes encore connecté !'];
            }
            
        }else{
            return ['statut' => false,'msg' => 'Une erreur est survenue lors de la génération du formulaire de paiement, vérifier que vous êtes encore connecté !'];
        }

        if(!empty($html)){
            return ['statut' => true,'formpay' => $html];
        }else{
            return ['statut' => false,'msg' => 'Une erreur est survenue, veuillez ressayer plus tard !'];
        }
    }

    public function generate_form_payment_cb_drop(Request $request){
        $html = '';
        if($request->session()->has('panier_mkp')){
            $panierDrop = $request->session()->get('panier_mkp');
            $panier = PanierEdi::where('id_panier_edi','=',$panierDrop->id_panier_edi)->first();
            if(isset($panier->id_panier_edi) && !empty($panier->id_panier_edi)){
                if($panier->total_ttc > 0){
                    $trans_id = TransactionPaiement::generate_id_transaction();
                    if(!empty($trans_id)){
                        $paiement = new Systempay();
                        $paiement->set([
                            'amount' => $panier->total_ttc,
                            'trans_id' => $trans_id,
                            'order_id' => $panier->num_commande,
                            'ext_info_id_panier_edi' => $panier->id_panier_edi,
                            'ext_info_type_vente' => 2,
                            'ext_info_id_distributeur' => Auth::id(),
                            'url_return' => url('/').'/dropshipping/cart/validation',
                            'url_cancel' => url('/').'/dropshipping/cart/validation',
                            'url_refused' => url('/').'/dropshipping/cart/validation',
                            'url_success' => url('/').'/shippings/order/clients/'.$panier->num_commande,
                            'url_check' => url('/').'/cart/validation/payment',
                        ]);
                        $html = $paiement->render();
                    }else{
                        return ['statut' => false,'erreur'=>5,'msg' => 'Une erreur est survenue, veuillez ressayer plus tard !'];
                    }     
                }else{
                    return ['statut' => false,'erreur'=>4,'msg' => 'Une erreur est survenue, vérifier que votre panier n\'est pas vide ou que vous êtes encore connecté !'];
                }
            }else{
                return ['statut' => false,'erreur'=>3,'msg' => 'Une erreur est survenue lors de la génération du formulaire de paiement, vérifier que vous êtes encore connecté !'];
            }
            
        }else{
            return ['statut' => false,'erreur'=>2,'msg' => 'Une erreur est survenue lors de la génération du formulaire de paiement, vérifier que vous êtes encore connecté !'];
        }

        if(!empty($html)){
            return ['statut' => true,'formpay' => $html];
        }else{
            return ['statut' => false,'erreur'=>1,'msg' => 'Une erreur est survenue, veuillez ressayer plus tard !'];
        }
    }

    public function confirmation_payment(Request $request){
        $validator = Validator::make($request->all(), [
            'vads_order_id' => 'required|string',
            'vads_trans_id' => 'required|string',
            'vads_trans_date' => 'required|date_format:YmdHis',
            'vads_result' => 'required|in:00,02,05,17',
            'vads_payment_config' => 'required|string',
            'vads_site_id' => 'required|string',
            'vads_auth_result' => 'required|string',
            'vads_capture_delay' => 'required|integer',
            'vads_ext_info_id_panier_edi' => 'required|integer',
            'vads_ext_info_type_vente' => 'required|integer',
            'vads_ext_info_id_distributeur' => 'required|integer',
            'signature' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            Log::debug('Error Request');
            Log::debug($request->all());
            return response('Invalid Request', Response::HTTP_BAD_REQUEST);
        }
    
        $systempayParameters = $request->all();
        $signature = $systempayParameters['signature'];
    
        // Check the signature
        $isValidSignature = TransactionPaiement::verifySystempaySignature($systempayParameters, $signature);
    
        if (!$isValidSignature) {
            Log::debug('Error Signature');
            return response('Invalid Signature', Response::HTTP_BAD_REQUEST);
        }
    
        // Check the status of the payment
        $paymentStatus = $systempayParameters['vads_result'];
    
        if ($paymentStatus !== '00') {
            Log::debug('Error payment not success');
        }else{
            if(!empty($systempayParameters['vads_payment_certificate']) && $systempayParameters['vads_payment_certificate'] != null && is_string($systempayParameters['vads_payment_certificate'])){
                if($systempayParameters['vads_ext_info_type_vente'] == 2){
                    $status = false;
                    if(isset($systempayParameters['vads_ext_info_id_panier_edi']) && !empty($systempayParameters['vads_ext_info_id_panier_edi']) ){
                        $status = CommandeMarketplace::add_commande(2,$systempayParameters['vads_ext_info_id_panier_edi'],2,$systempayParameters['vads_ext_info_id_distributeur']);
                    }
                  
                    if($status){
                         Commande::create_facture($systempayParameters['vads_ext_info_id_panier_edi'],2,$systempayParameters['vads_ext_info_id_distributeur']);
                    }else{
                        Log::debug('Erreur Création Commande : '.$systempayParameters['vads_ext_info_id_panier_edi']);
                    }
                }else{
                    $panierGet = PanierEdi::where('id_panier_edi', '=', $systempayParameters['vads_ext_info_id_panier_edi'])->first();
                    if(isset($panierGet->id_panier_edi) && $panierGet->id_panier_edi > 0){
                        $status = Commande::create_facture($panierGet->id_panier_edi,2,$systempayParameters['vads_ext_info_id_distributeur']);
                        $panierEdi = PanierEdi::where('id_panier_edi', '=', $panierGet->id_panier_edi)->first();
                        $panierEdi->is_validate = 1;
                        $panierEdi->id_etape = 2;
                        $panierEdi->total_payer = $panierGet->total_ttc;
                        $panierEdi->payment_type = 2;
                        $panierEdi->date_commande = date('Y-m-d');
                        $panierEdi->date_livraison = date('Y-m-d', strtotime('NOW + 14 DAYS'));
                        $panierEdi->save();
                    }
                }
            }else{
                Log::debug('Erreur payment');
            }
        }

        return response('OK', Response::HTTP_OK);
    }

   

    /**
    * Permet de confirmer la commande des clients en l'ajoutant aux commandes à préparer
    */
   public function confirmation_order_clients_drop(Request $request){
    $panierMarketplace = $request->session()->get('panier_mkp');
    $status = false;
    if($request->paymentType == 2){
       $etape = 2;
    }else{
       $etape = 1;
    }
    if($request->paymentType == 1){
        if(isset($panierMarketplace->id_panier_edi) && !empty($panierMarketplace->id_panier_edi) && isset($request->paymentType) && !empty($request->paymentType)){
            $status = CommandeMarketplace::add_commande($etape,$panierMarketplace->id_panier_edi,$request->paymentType,Auth::id());
          }
    }else{
        $status = CommandeMarketplace::add_commande(2,$panierMarketplace->id_panier_edi,2,Auth::id());
    }
    

    if($status){
       Commande::create_facture($panierMarketplace->id_panier_edi,$request->paymentType,Auth::id());
       return ['status'=>$status,'num_commande' => $panierMarketplace->num_commande];
    }else{
       return ['status'=>$status];
    }
 }

    /**
     * Permet de confirmer la commande des clients en l'ajoutant aux commandes à préparer
     */
    public function confirmation_panier_com(Request $request)
    {
        $panierCommercial = $request->session()->get('panier_commercial');
        $status = false;
        if($request->paymentType == 1){
            $etape = 1;
            if (isset($panierCommercial->id_panier_edi) && !empty($panierCommercial->id_panier_edi) && isset($request->paymentType) && !empty($request->paymentType)) {
                $status = Commande::create_facture($panierCommercial->id_panier_edi,$request->paymentType,Auth::id());
                $panierEdi = PanierEdi::where('id_panier_edi', '=', $panierCommercial->id_panier_edi)->first();
                $panierEdi->is_validate = 1;
                $panierEdi->id_etape = $etape;
                $panierEdi->payment_type = $request->paymentType;
                $panierEdi->date_commande = date('Y-m-d');
                $panierEdi->date_livraison = ($request->paymentType == 2 ? date('Y-m-d', strtotime('NOW + 14 DAYS')) : '');
                $panierEdi->save();
            }
    
            if ($status) {
                $request->session()->forget('client_commercial');
                $request->session()->forget('panier_commercial');
                return ['status' => $status, 'num_commande' => $panierCommercial->num_commande];
            } else {
                return ['status' => $status];
            }
        }else {
            return ['status' => $status];
        }
        
    }

    public function create_adresse_drop(Request $request){
        if($request->session()->has('panier_mkp')){
            $panier = $request->session()->get('panier_mkp');
            $id_client_edi = $panier->client_edi_list[0]->id_client_edi;
            if(empty($id_client_edi)){
                return Redirect::route('dropshipping/cart');
            }else{
                $isvalid = true;
                foreach($panier->client_edi_list as $client){
                    if($client->quantiter == 0){
                        $isvalid = false;
                    }
                }
                if(!$isvalid){
                    return Redirect::route('dropshipping/cart');
                }
            }
        }else{
            return Redirect::route('dropshipping/cart');
        }

        return Inertia::render('Auth/Pages/Cart/AdressesDrop');
    }

}
