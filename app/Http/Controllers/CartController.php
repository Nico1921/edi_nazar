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
                            'trans_id' => $trans_id
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
    if(isset($panierMarketplace->id_panier_edi) && !empty($panierMarketplace->id_panier_edi) && isset($request->paymentType) && !empty($request->paymentType)){
       $clientsList = ClientEDI::where('id_panier_edi','=',$panierMarketplace->id_panier_edi)->get();
       if(!empty($clientsList) && count($clientsList) > 0) {
          foreach($clientsList as $clientOne){     
             $panierList = PanierEdiList::where('id_client_edi','=',$clientOne->id_client_edi)->get();
             if(!empty($panierList) && count($panierList) > 0){
                $num_client = ClientMarketplace::genNumClient();
                $url_client = urlencode($clientOne->nom . '-' . $clientOne->prenom);
                $clientMarketplace = ClientMarketplace::create([
                   'date_ajout' => date('Y-m-d H:i:s'),
                   'date_maj' => date('Y-m-d H:i:s'),
                   'id_user' => '0',
                   'id_user_maj' => '0',
                   'email' => $clientOne->email,
                   'num_client' => $num_client ,
                   'is_societe' => '0',
                   'civilite' => '',
                   'societe' => '',
                   'nom' => $clientOne->nom,
                   'prenom' => $clientOne->prenom,
                   'tva_intra' => null,
                   'siret' => null,
                   'adresse1' => $clientOne->adresse1_facturation,
                   'adresse2' => $clientOne->adresse2_facturation,
                   'adresse3' => $clientOne->adresse3_facturation,
                   'code_postal' => $clientOne->code_postal_facturation,
                   'ville' => $clientOne->ville_facturation,
                   'pays' => $clientOne->pays_facturation,
                   'tel1' => $clientOne->tel_facturation,
                   'tel2' => '',
                   'fax' => '',
                   'url_client' => $url_client,
                   'commentaire' => '',
                   'newsletter' => '0',
                   'id_type_client' => '1',
                   'commission' => '0',
                   'code_compta' => null,
                ]);

                $adresseMarketplace = AdresseMarketplace::create([
                   'date_ajout' => date('Y-m-d H:i:s'),
                   'date_maj' => date('Y-m-d H:i:s'),
                   'id_user' => '0',
                   'id_user_maj' => '0',
                   'id_client' => $clientMarketplace->id_client,
                   'adresse1' => $clientOne->adresse1,
                   'adresse2' => $clientOne->adresse2,
                   'adresse3' => $clientOne->adresse3,
                   'code_postal' => $clientOne->code_postal,
                   'ville' => $clientOne->ville,
                   'pays' => $clientOne->pays,
                   'nom_contact' => $clientOne->nom_adresse,
                   'tel1' => $clientOne->tel,
                   'email' => $clientOne->email,
                   'code1' => null,
                   'code2' => null,
                   'delai' => null,
                   'note' => null,
                   'pr_nom' => null,
                   'pr_id' => null,
                   'is_pr' => 0,
                   'id_commande' => '0',
                   'tel2' => '',
                   'is_relai' => '',
                ]);

                $userLogin = User::find(Auth::id());

                $commandeMarketplace = CommandeMarketplace::create([
                   'id_user' => 0,
                   'id_user_maj' => 0,
                   'id_livraison' => $adresseMarketplace->id_adresse,
                   'id_etape' => $etape,
                   'date_ajout' => date('Y-m-d H:i:s'),
                   'date_maj' => date('Y-m-d H:i:s'),
                   'id_client' => $clientMarketplace->id_client,
                   'date_commande' => $clientOne->date_commande,
                   'num_commande' => CommandeMarketplace::generateNumOrder(),
                   'quantite' => $clientOne->quantiter,
                   'taux_tva' => 20,
                   'montant_ht' => $clientOne->total_ht,
                   'montant_tva' => $clientOne->total_taxe,
                   'montant_ttc' => $clientOne->total_ttc,
                   'remise_ttc' => '0',
                   'frais_port_ht' => '0',
                   'frais_port_tva' => '0',
                   'frais_port_ttc' => '0',
                   'due_ttc' => '0',
                   'total_tva' => $clientOne->total_taxe,
                   'total_ht' => $clientOne->total_ht,
                   'total_ttc' => $clientOne->total_ttc,
                   'date_facture' => NULL,
                   'num_facture' => NULL,
                   'date_env_order' => NULL,
                   'send_order' => 0,
                   'date_env_invoice' => NULL,
                   'send_invoice' => 0,
                   'commentaire' => '',
                   'gen_facture' => 0,
                   'date_echeance' => $clientOne->date_commande,
                   'statut' => '0',
                   'nom_etape' => 'en attente de validation',
                   'mode_reglement' => '0',
                   'date_envoie' => NULL,
                   'env_order' => 0,
                   'CGV' => 0,
                   'id_distributeur' => $userLogin->id_client,
                   'md5_commande' => '',
                   'ref_externe' => $clientOne->num_commande,
                   'commission_p' => 0,
                   'commission_ht' => 0,
                   'commission_ttc' => 0,
                   'import' => 0,
                   'total_eco_ht' => 0,
                   'total_eco_ttc' => 0,
                   'id_societe' => 1,
                   'frais_supp_ht' => 0,
                   'frais_supp_tva' => 0,
                   'frais_supp_ttc' => 0,
                   'infos' => '',
                   'frais_port_reel_ttc' => 0,
                   'id_reduction' => NULL,
                   'provenance' => 1,
                   'mode_livraison' => NULL,
                   'is_market' => 1,
                   'date_expedition' => '0000-00-00',
                   'date_livraison' => NULL,
                   'date_delivery' => NULL,
                   'marge_ht' => 0,
                   'is_ws' => 1,
                   'id_transport' => 1,
                   'poids' =>  $clientOne->poids,
                   'order_id' => 0,
                   'filled' => 0,
                   'return_id' => 0,
                   'total_refund' => 0,
                   'tracking_sm' => 0,
                ]);

                $commandeMarketplace->md5_commande = md5($commandeMarketplace->id_commande);
                $commandeMarketplace->save();

                $adresseMarketplace->id_commande = $commandeMarketplace->id_commande;
                $adresseMarketplace->save();

                foreach($panierList as $produitCommande){
                   $p = Produit::with(['dimension','design','couleur'])->where('id_produit','=',$produitCommande->id_produit)->first();
                   $gamme = Gamme::where('id_gamme','=',$p->design->id_gamme)->first();

                   $prix_achat_ht = $gamme->prix_achat_ht_m2 * ($p->dimension->longueur / 100 * $p->dimension->largeur / 100);
                   $prix_achat_ht = sprintf("%.2f", $prix_achat_ht);

                   CommandeMarketplaceList::create([
                      'id_commande' =>$commandeMarketplace->id_commande,
                      'id_produit' => $produitCommande->id_produit,
                      'ref_produit' => $p->code_sku,
                      'nom_produit' => $gamme->nom_gamme." - ".$p->design->nom_design." ".$p->couleur->nom_couleur." ".$p->dimension->largeur."x".$p->dimension->longueur,
                      'quantite' => $produitCommande->quantiter,
                      'taux_tva' => 20,
                      'prix_ht' => $produitCommande->prix_ht_unitaire,
                      'prix_ttc' => $produitCommande->prix_ttc_unitaire,
                      'eco_ttc',
                      'remise',
                      'commission_p',
                      'commission_ttc',
                      'frais_port_ttc',
                      'total_tva' => $produitCommande->prix_taxe_total,
                      'total_ht' => $produitCommande->prix_ht_total,
                      'total_ttc' => $produitCommande->prix_ttc_total,
                      'frais_port_ht' => 0,
                      'total_port_ttc' => 0,
                      'total_port_ht' => 0,
                      'total_eco_ht' => 0,
                      'total_eco_ttc' => 0,
                      'ref_couleur' => NULL,
                      'nom_couleur' => NULL,
                      'barcode' => '',
                      'id_categorie' => NULL,
                      'code_EAN' => $p->gencode,
                      'remise_sup_ttc' => 0,
                      'prix_achat_ht' => $prix_achat_ht,
                      'pourcentage_produit' => 0,
                      'delai' => NULL,
                      'note' => '',
                      'qte_preparee' => 0,
                      'date_preparee' => NULL,
                      'rupture' => 0,
                      'manuel' => 0,
                      'order_item_id' => '',
                   ]);
                }

                if(isset($commandeMarketplace->id_commande) && !empty($commandeMarketplace->id_commande) && $commandeMarketplace->id_commande > 0){
                   $status = true;
                }
             }
          }

          $panierEdi = PanierEdi::where('id_panier_edi','=',$panierMarketplace->id_panier_edi)->first();
          $panierEdi->is_validate = 1;
          $panierEdi->id_etape = $etape;
          $panierEdi->date_commande = date('Y-m-d');
          $panierEdi->date_livraison = date('Y-m-d', strtotime('NOW + 72 HOURS'));
          $panierEdi->save();
       }
       
    }

    if($status){
       Commande::create_facture($panierMarketplace->id_panier_edi,$request->paymentType);
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
        if($request->paymentType == 2){
            $etape = 2;
         }else{
            $etape = 1;
         }
        if (isset($panierCommercial->id_panier_edi) && !empty($panierCommercial->id_panier_edi) && isset($request->paymentType) && !empty($request->paymentType)) {
            $status = Commande::create_facture($panierCommercial->id_panier_edi,$request->paymentType);
            $panierEdi = PanierEdi::where('id_panier_edi', '=', $panierCommercial->id_panier_edi)->first();
            $panierEdi->is_validate = 1;
            $panierEdi->id_etape = $etape;
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
