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
                $id_client_edi = $panierCom->client_edi_list->id_client_edi;
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
            $panier = PanierEdi::where('id_panier_edi','=',$panierCommercial->id_panier_edi)->find();
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

}
