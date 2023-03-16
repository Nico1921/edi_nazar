<?php

namespace App\Http\Controllers;

use App\Imports\CommandeMarketplaceImport;
use App\Models\AdresseMarketplace;
use App\Models\ClientEDI;
use App\Models\ClientMarketplace;
use App\Models\Commande;
use App\Models\CommandeMarketplace;
use App\Models\CommandeMarketplaceList;
use App\Models\Facture;
use App\Models\PanierEdi;
use App\Models\PanierEdiList;
use App\Models\Produit;
use App\Models\User;
use App\Models\Gamme;
use App\Models\StatsProduit;
use Illuminate\Database\Query\Builder;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class DropshippingController extends Controller
{

   /**
     * Permet de basculer en type de vente BtoC et renvoie à la page des gammes
     * 
     * @return Redirect
     */
   public function create_type_vente(Request $request){
      $request->session()->put('typeVente', 2);
      return redirect('/dropshipping/gamme');
   }

   /**
     * Affiche les gammes de produit
     * 
     * @return \Inertia\Response
     */
   public function create_client_gamme(Request $request)
   {

      if ($request->session()->has('client_actuel')) {
         $client = $request->session()->get('client_actuel');
         $panier = PanierEdi::where('id_panier_edi','=',$client->id_panier_edi)->first();
         if(isset($panier->id_panier_edi) && !empty($panier->id_panier_edi) && !$panier->is_validate){
            $produitsAchat = new \stdClass;
            $panierList = PanierEdiList::where('id_client_edi','=',$client->id_client_edi)->get();
                  foreach($panierList as $list){
                     $produit = Produit::with(['photo','dimension','statsProduit','design','couleur'])->where('id_produit','=',$list->id_produit)->get();
                     for($i=0;$i<count($produit);$i++){
                        $produit[$i]->prix_produit = Produit::calcul_prix_produit($produit[$i]->id_produit);
                        $gamme = Gamme::where('id_gamme','=',$produit[$i]->design->id_gamme)->first();
                        $panier = PanierEdiList::where('id_produit','=',$produit[$i]->id_produit)->where('id_client_edi','=',$client->id_client_edi)->first();
                        $produit[$i]->gamme = $gamme;
                        $produit[$i]->panier = $panier;
                        $produit[$i]->isInPanier = true;
                        $produitsAchat->panier[] = $produit[$i];
                     }
                  }
         }
      }else{
         $client = new \stdClass;
         $panier = new \stdClass;
         $produitsAchat = new \stdClass;
      }

        $gammeSearch = AllowedFilter::callback('nom_gamme', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('gamme.nom_gamme', 'LIKE', "%{$value}%");
                });
            });
        });


        $products = QueryBuilder::for(Gamme::class)
            ->defaultSort('gamme.nom_gamme')
            ->select(['gamme.*','special.nom_special'])
            ->join('special', 'special.id_special', 'gamme.id_special')
            ->where('gamme.in_edi', '=', '1')
            ->where('gamme.statut', '=', '1')
            ->allowedFilters([$gammeSearch])
            ->paginate((request('perPage') != "" ? request('perPage') : '12'))
            ->withQueryString();
        
        $dimensions = DB::table('gamme')
            ->select(['gamme.id_gamme','dimension.largeur','dimension.longueur'])
            ->distinct()
            ->join('design', 'gamme.id_gamme', 'design.id_gamme')
            ->join('produit', 'design.id_design', 'produit.id_design')
            ->join('dimension', 'produit.id_dimension', 'dimension.id_dimension')
            ->where('gamme.in_edi', '=', '1')
            ->where('gamme.statut', '=', '1')
            ->orderBy('dimension.largeur')
            ->orderBy('dimension.longueur')
            ->get();


        // error_log(print_r($products));
        return Inertia::render('Auth/Pages/Dropshipping/Clients/Gammes', [
            'products' => $products,
            'dimensions' => $dimensions,
            'client'=>$client,
            'produitsAchat' => $produitsAchat,
        ]);
   } 

   /**
     * Affiche les produits que l'on peux ajouter à la commande du client
     * 
     * @return \Inertia\Response
     */
   public function create_client_products(Request $request,$gamme)
   {
      if ($request->session()->has('client_actuel')) {
         $client = $request->session()->get('client_actuel');
         $panier = PanierEdi::where('id_panier_edi','=',$client->id_panier_edi)->first();
         if(isset($panier->id_panier_edi) && !empty($panier->id_panier_edi) && !$panier->is_validate){
            $produitsAchat = new \stdClass;
            $panierList = PanierEdiList::where('id_client_edi','=',$client->id_client_edi)->get();
            foreach($panierList as $list){
               $produit = Produit::with(['photo','dimension','statsProduit','design','couleur'])->where('id_produit','=',$list->id_produit)->get();
               for($i=0;$i<count($produit);$i++){
                  $produit[$i]->prix_produit = Produit::calcul_prix_produit($produit[$i]->id_produit);
                  $gammeGet = Gamme::where('id_gamme','=',$produit[$i]->design->id_gamme)->first();
                  $panier = PanierEdiList::where('id_produit','=',$produit[$i]->id_produit)->where('id_client_edi','=',$client->id_client_edi)->first();
                  $produit[$i]->gamme = $gammeGet;
                  $produit[$i]->panier = $panier;
                  $produit[$i]->isInPanier = true;
                  $produitsAchat->panier[] = $produit[$i];
               }
            }
         }else{
            $panier = new \stdClass;
            $produitsAchat = new \stdClass;
         }
      }else{
         $panier = new \stdClass;
         $produitsAchat = new \stdClass;
      }
            $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
               $query->where(function ($query) use ($value) {
                   Collection::wrap($value)->each(function ($value) use ($query) {
                       $query
                           ->orWhere('couleur.nom_couleur', 'LIKE', "%{$value}%")
                           ->orWhere('gamme.nom_gamme', 'LIKE', "%{$value}%")
                           ->orWhere('code_sku', 'LIKE', "%{$value}%")
                           ->orWhere('gencode', 'LIKE', "%{$value}%")
                           ->orWhere('design.nom_design', 'LIKE', "%{$value}%");
                   });
               });
           });
   
           $gammeSearch = AllowedFilter::callback('nom_gamme', function ($query, $value) {
               $query->where(function ($query) use ($value) {
                   Collection::wrap($value)->each(function ($value) use ($query) {
                       $query
                           ->orWhere('gamme.nom_gamme', 'LIKE', "%{$value}%");
                   });
               });
           });
   
           
           $products = QueryBuilder::for(Produit::class)
           ->defaultSort('nom_design')
           ->select(['produit.id_design','produit.id_produit','couleur.nom_couleur','gamme.nom_gamme','design.nom_design','photo.img_produit'])
           ->join('design','produit.id_design','design.id_design')
           ->join('couleur','produit.id_couleur','couleur.id_couleur')
           ->join('photo','produit.id_produit','photo.id_produit')
           ->join('gamme','design.id_gamme','gamme.id_gamme')
           ->where('gamme.nom_gamme', 'like', '%'.$gamme.'%')
           ->where('produit.code_sku','!=','null')
           ->where('produit.code_sku','!=','""')
           ->where('produit.drop_shipping','=','1')
           ->where('produit.statut','=','1')
           ->where('photo.principale','=','1')
           ->allowedSorts(['nom_design','nom_couleur','nom_gamme','code_sku'])
           ->allowedFilters([$globalSearch,$gammeSearch,'nom_couleur','nom_design'])
           ->groupBy(['produit.id_design'])
           ->paginate(request('perPage'))
           ->withQueryString();

          
   
           return Inertia::render('Auth/Pages/Dropshipping/Clients/Products', [
               'products' => $products,
               'produitsAchat' => $produitsAchat,
               'gamme' => $gamme,
           ])->table(function (InertiaTable $table) {
               $table
                 ->withGlobalSearch()
                 ->defaultSort('nom_design')
                 ->column(key: 'img_produit',label: 'Image', searchable: false, sortable: false)
                 ->column(key: 'nom_gamme',label: 'Gamme', searchable: true, sortable: true)
                 ->column(key: 'nom_design',label: 'Design', searchable: true, sortable: true)
                 ->column(key: 'nom_couleur',label: 'Couleur', searchable: true, sortable: true)
                 ->column(label: 'Détails', searchable: true, sortable: true);});
   }

   /**
     * Recherche dans les gammes de produit
     * 
     * @return \Inertia\Response
     */
   public function create_client_gamme_post()
   {

        $gammeSearch = AllowedFilter::callback('nom_gamme', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('gamme.nom_gamme', 'LIKE', "%{$value}%");
                });
            });
        });


        $products = QueryBuilder::for(Gamme::class)
            ->defaultSort('gamme.nom_gamme')
            ->select(['gamme.*','special.nom_special'])
            ->join('special', 'special.id_special', 'gamme.id_special')
            ->where('gamme.in_edi', '=', '1')
            ->where('gamme.statut', '=', '1')
            ->allowedFilters([$gammeSearch])
            ->paginate((request('perPage') != "" ? request('perPage') : '12'))
            ->withQueryString();


        // error_log(print_r($products));
        return [
            'products' => $products
        ];
   }

   /**
     * Permet la recherche de produit via une requete en post
     * 
     * @return Array
     */
   public function create_product_post($gamme)
   {

        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('couleur.nom_couleur', 'LIKE', "%{$value}%")
                        ->orWhere('gamme.nom_gamme', 'LIKE', "%{$value}%")
                        ->orWhere('code_sku', 'LIKE', "%{$value}%")
                        ->orWhere('gencode', 'LIKE', "%{$value}%")
                        ->orWhere('design.nom_design', 'LIKE', "%{$value}%");
                });
                
            });
        });

        $products = QueryBuilder::for(Produit::class)
            ->defaultSort('nom_design')
            ->select(['produit.id_design', 'couleur.nom_couleur', 'gamme.nom_gamme', 'design.nom_design', 'photo.img_produit'])
            ->join('design', 'produit.id_design', 'design.id_design')
            ->join('couleur', 'produit.id_couleur', 'couleur.id_couleur')
            ->join('photo', 'produit.id_produit', 'photo.id_produit')
            ->join('gamme', 'design.id_gamme', 'gamme.id_gamme')
            ->where('gamme.nom_gamme', 'like', '%'.$gamme.'%')
            ->where('produit.code_sku', '!=', 'null')
            ->where('produit.code_sku', '!=', '""')
            ->where('produit.drop_shipping', '=', '1')
            ->where('produit.statut', '=', '1')
            ->where('photo.principale', '=', '1')
            ->allowedSorts(['nom_design', 'nom_couleur', 'nom_gamme', 'code_sku'])
            ->allowedFilters([$globalSearch])
            ->groupBy(['produit.id_design'])
            ->paginate(request('perPage'))
            ->withQueryString();


        // error_log(print_r($products));
        return [
            'products' => $products,
            'gamme' => $gamme,
        ];
   }

   /**
     * Récupére les variations de produit d'un design 
     * 
     * @return Array
     */
   public function getProductsDesignPanier(Request $request)
   {
      $id_design = $request->post()['id_design'];
      if($request->session()->has('client_actuel')){
         $client = $request->session()->get('client_actuel');
      }else{
         $client = new \stdClass;
      }
      
      $produits = array();
         $sort = 'asc';
         $produits = Produit::with(['photo', 'dimension' => function($query) use ($sort) {
            $query->orderBy('largeur',$sort);
        }, 'statsProduit'])->join('dimension','dimension.id_dimension','=','produit.id_dimension')->orderBy('dimension.largeur',$sort)->orderBy('dimension.longueur',$sort)->where('id_design', '=', $id_design)->get();
         for($i=0;$i<count($produits);$i++){
            $produits[$i]->prixProduit = Produit::calcul_prix_produit($produits[$i]->id_produit);
            if(isset($client->id_client_edi)){
               if(PanierEdiList::where('id_produit','=',$produits[$i]->id_produit)->where('id_client_edi','=',$client->id_client_edi)->exists()){
                  $panier = PanierEdiList::where('id_produit','=',$produits[$i]->id_produit)->where('id_client_edi','=',$client->id_client_edi)->first();
                  $produits[$i]->panier = $panier;
                  $produits[$i]->isInPanier = true;
                  
               }else{
                  $produits[$i]->panier = array("quantiter" => 0);
                  $produits[$i]->isInPanier = false;
               }
               $produits[$i]->id_client_edi = $client->id_client_edi;
            }else{
               $produits[$i]->panier = array("quantiter" => 0);
               $produits[$i]->isInPanier = false;
               $produits[$i]->id_client_edi = '';
            }
            $produits[$i]->dateGet = date('d/m/Y H:i:s');
      }
      
      return $produits;
   }

   /**
    * Ajoute un client avec uniquement la référence de sa commande
    * @return Array
    */
   public function add_ref_client(Request $request){
      if ($request->session()->has('panier_mkp')) {
         $panierMK = $request->session()->get('panier_mkp');
         $request->validate([
            'ref_externe' => [
               'required',
               'string',
               'max:250',
               Rule::unique('client_edi','ref_externe')->where(fn (Builder $query) => $query->where('id_panier_edi', $panierMK->id_panier_edi)),
            ],
         ]);
      }else{
         $request->validate([
            'ref_externe' => [
               'required',
               'string',
               'max:250'
            ],
         ]);
      }

      

      if (!$request->session()->has('panier_mkp')) {
         $num_commande = PanierEdi::generateNumOrder();
         $panierMarketplace = PanierEdi::create([
            'date_ajout' => date('Y-m-d H:i:s'),
            'date_maj' => date('Y-m-d H:i:s'),
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
            'is_marketplace' => '1',
            'id_etape' => '1',
            'id_users' => Auth::user()->getAuthIdentifier(),
         ]);
      }else{
         $panierMarketplace = $request->session()->get('panier_mkp');
         $panierMarketplace->id_panier_edi = $panierMarketplace->id_panier_edi;
      }

      if(isset($panierMarketplace->id_panier_edi) && !empty($panierMarketplace->id_panier_edi)){
         $num_commande = ClientEdi::genNumCommande($panierMarketplace->id_panier_edi);
         $clientMarketplace = ClientEDI::create([
            'date_ajout' => date('Y-m-d H:i:s'),
            'date_maj' => date('Y-m-d H:i:s'),
            'nom' => '',
            'prenom' => '',
            'email' => '',
            'tel' => '',
            'date_commande' => date('Y-m-d'),
            'ref_externe' => $request->ref_externe,
            'nom_adresse' => '',
            'adresse1' => '',
            'adresse2' => '',
            'adresse3' => '',
            'pays' => '',
            'code_postal' => '',
            'ville' => '',
            'nom_adresse_facturation' => '',
            'adresse1_facturation' => '',
            'adresse2_facturation' => '',
            'adresse3_facturation' => '',
            'pays_facturation' => '',
            'code_postal_facturation' => '',
            'ville_facturation' => '',
            'num_commande' => $num_commande,
            'quantiter' => 0,
            'poids' => 0,
            'total_ht' => 0,
            'total_taxe' => 0,
            'total_ttc' => 0,
            'total_m2' => 0,
            'id_panier_edi' => $panierMarketplace->id_panier_edi
         ]);
      }else{
         $clientMarketplace = '';
      }
   
      if(isset($clientMarketplace->id_client_edi) && !empty($clientMarketplace->id_client_edi)){
         $panierGet = PanierEdi::with('client_edi_list')->where('id_panier_edi','=',$panierMarketplace->id_panier_edi)->first();
         if ($request->session()->has('panier_mkp')) {
            $panierActual = $request->session()->get('panier_mkp');
            $panierGet = PanierEdi::find($panierActual->id_panier_edi);
            if(isset($panierGet->id_panier_edi) && !empty($panierGet->id_panier_edi)){
               $panierGet->nb_client = $panierActual->nb_client+1;
               $panierGet->save();
            }
         }
         $request->session()->put('panier_mkp',$panierGet);
         $clientGet = ClientEDI::with('panier')->where('id_client_edi','=',$clientMarketplace->id_client_edi)->first();
         $request->session()->put('client_actuel',$clientGet);
         return redirect()->back()->with(['statut' => true,'id_client_edi' => $clientMarketplace->id_client_edi]);
      }else{
         return redirect()->back()->with(['statut' => false,'msg' => 'Une erreur est survenue lors de la création de la commande, veuillez recommencer plus tard !']);
      }
   }

   /**
     * Suprimme la commande du client
     */
    public function delete_order_client(Request $request){
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

   /**
     * Affiche la vue pour crée une commande d'un client d'une commande déja existante
     * 
     * @return \Inertia\Response
     */
    public function create_add_clients(Request $request)
    {
      if($request->session()->has('panier_mkp')){
         $panier = $request->session()->get('panier_mkp');
         return Inertia::render('Auth/Pages/Orders/Clients',['panier' => $panier]);
      }else{
         return Redirect::route('orders/clients');
      }
        
    }

    /**
     * Affiche la vue pour crée une commande d'un client
     * 
     * @return \Inertia\Response
     */
    public function create_clients(Request $request)
    {
      if($request->session()->has('panier_mkp')){
         $request->session()->forget('panier_mkp');
      }

      if($request->session()->has('client_actuel')){
         $request->session()->forget('client_actuel');
      }
      
      return Inertia::render('Auth/Pages/Orders/Clients');
    }

    /**
     * Ajoute le client et l'insère dans une variable de session pour ajouter les produits à sa commande par la suite 
     * 
     * @return \Inertia\Response
     */
    public function add_client(Request $request){

      $request->validate([
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

     if (!$request->session()->has('panier_mkp')) {
      $num_commande = PanierEdi::generateNumOrder();
      $panierMarketplace = PanierEdi::create([
         'date_ajout' => date('Y-m-d H:i:s'),
         'date_maj' => date('Y-m-d H:i:s'),
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
         'is_marketplace' => '1',
         'id_etape' => '1',
         'id_users' => Auth::user()->getAuthIdentifier(),
      ]);
      }else{
         $panierMarketplace = $request->session()->get('panier_mkp');
         $panierMarketplace->id_panier_edi = $panierMarketplace->id_panier_edi;
      }

      if(isset($panierMarketplace->id_panier_edi) && !empty($panierMarketplace->id_panier_edi)){
         $num_commande = ClientEdi::genNumCommande($panierMarketplace->id_panier_edi);
         $clientMarketplace = ClientEDI::create([
            'date_ajout' => date('Y-m-d H:i:s'),
            'date_maj' => date('Y-m-d H:i:s'),
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'tel' => $request->tel,
            'date_commande' => date('Y-m-d'),
            'nom_adresse' => $request->nom_adresse,
            'adresse1' => $request->adresse1,
            'adresse2' => $request->adresse2,
            'adresse3' => $request->adresse3,
            'pays' => $request->pays,
            'code_postal' => $request->code_postal,
            'ville' => $request->ville,
            'nom_adresse_facturation' => $request->nom_adresse,
            'adresse1_facturation' => $request->adresse1,
            'adresse2_facturation' => $request->adresse2,
            'adresse3_facturation' => $request->adresse3,
            'pays_facturation' => $request->pays,
            'code_postal_facturation' => $request->code_postal,
            'ville_facturation' => $request->ville,
            'num_commande' => $num_commande,
            'quantiter' => 0,
            'poids' => 0,
            'total_ht' => 0,
            'total_taxe' => 0,
            'total_ttc' => 0,
            'total_m2' => 0,
            'id_panier_edi' => $panierMarketplace->id_panier_edi
         ]);
      }else{
         $clientMarketplace = '';
      }
   
      if(isset($clientMarketplace->id_client_edi) && !empty($clientMarketplace->id_client_edi)){
         $panierGet = PanierEdi::with('client_edi_list')->where('id_panier_edi','=',$panierMarketplace->id_panier_edi)->first();
         if ($request->session()->has('panier_mkp')) {
            $panierActual = $request->session()->get('panier_mkp');
            $panierGet = PanierEdi::find($panierActual->id_panier_edi);
            if(isset($panierGet->id_panier_edi) && !empty($panierGet->id_panier_edi)){
               $panierGet->nb_client = $panierActual->nb_client+1;
               $panierGet->save();
            }
         }
         $request->session()->put('panier_mkp',$panierGet);
         $clientGet = ClientEDI::with('panier')->where('id_client_edi','=',$clientMarketplace->id_client_edi)->first();
         $request->session()->put('client_actuel',$clientGet);
         return Redirect::route('orders/clients/products');
      }else{
         return Inertia::render('Auth/Pages/Orders/Clients',['statusPanier'=>false]);
      }
      
    }

    /**
     * Traite le fichier excel qu'on lui fournis et renvoie un tableau avec toute les données
     */
    public function add_client_import(Request $request){
      $request->validate(['fileImport' => 'required|file|mimes:xls,xlsx']);
      
      $imports = Excel::import(new CommandeMarketplaceImport,$request->file('fileImport')->store('temp'))->toCollection(new CommandeMarketplaceImport,$request->file('fileImport')->store('temp'));
      $erreur = 0;
      $valider = 0;
      $stockInvalid = false;
      $clients = [];
      $qteTT = 0;
      $m2Final = 0;
      $prixHT_TT = 0;
      $prixTVA_TT = 0;
      $prixTTC_TT = 0;
      foreach($imports[0] as $import){
         $eanProduct = $import['ean_product'];
         $product = Produit::with(['dimension', 'design','statsProduit','photo'])->where('gencode','=',$eanProduct)->first();
         if(isset($product->id_produit) && !empty($product->id_produit)){
            $gamme = Gamme::where('id_gamme', '=', $product->design->id_gamme)->first();
            $m2 = ($product->dimension->largeur / 100) + ($product->dimension->longueur / 100);         
            $poidsUnitaire = $m2 * $gamme->poids_m2_KG;         
            $lastname = $import['lastname'];
            $firstname = $import['firstname'];
            $idArray = array_search($import['num_order'], array_column($clients, 'num_commande'));
            $m2TT = $m2 * $import['qte'];
            $clientProduitStockInvalide = false;
            $prix_TTC_unitaire = Produit::calcul_prix_produit($product->id_produit);
            $prixTTC_TT = round($prixTTC_TT + ($prix_TTC_unitaire * $import['qte']),2);
            $prixTVA_TT = round($prixTTC_TT * 0.2,2);
            $prixHT_TT = $prixTTC_TT - $prixTVA_TT;
            if($import['qte'] >= $product->statsProduit->stock_restant){
               $stockInvalid = true;
               $clientProduitStockInvalide = true;
            }
            if($idArray === false){
               $prix_TTC_client = round($prix_TTC_unitaire * $import['qte'],2);
               $prixTVA_client = round($prixTTC_TT * 0.2,2);
               $prixHT_client = $prix_TTC_client - $prixTVA_client;
               $poidsTotal = $m2TT * $gamme->poids_m2_KG;
               $clients[] = [
                  'status' => true,
                  'clientProduitStockInvalide' => $clientProduitStockInvalide,
                  "num_commande" => $import['num_order'],
                  "prenom" => $firstname,
                  "nom" => $lastname,
                  "products_tt" => $import['qte'],
                  "m2_tt" => round($m2TT,2),
                  "prix_ht_tt" => $prixHT_client,
                  "prix_tva_tt" => $prixTVA_client,
                  "prix_ttc_tt" => $prix_TTC_client,
                  "m2_tt" => round($m2TT,2),
                  "m2_tt" => round($m2TT,2),
                  "adresse_livraison" => [
                     "nom_adresse" => $import["nameaddr"],
                     "adresse1" => $import['addr1'],
                     "adresse2" => $import['addr2'],
                     "adresse3" => $import['addr3'],
                     "code_postal" => $import['zipcode'],
                     "ville" => $import['city'],
                     "pays" => $import['country'],
                     "tel" => $import['phone'],
                     "mail" => $import['mail']
                  ],
                  "adresse_facturation" => [
                     "nom_adresse" => $import["nameaddr"],
                     "adresse1" => $import['addrbill1'],
                     "adresse2" => $import['addrbill2'],
                     "adresse3" => $import['addrbill3'],
                     "code_postal" => $import['zipcode_bill'],
                     "ville" => $import['city_bill'],
                     "pays" => $import['country_bill'],
                     "tel" => $import['phone_bill'],
                     "mail" => $import['mail_bill']
                  ],
                  "products" => [
                     [
                        "id_produit" => $product->id_produit,
                        "prix_TTC_unitaire" => $prix_TTC_unitaire,
                        "gamme" => $gamme->nom_gamme,
                        "poids_unitaire" => round($poidsUnitaire,2),
                        "poids_total" => round($poidsTotal,2),
                        "m2_unitaire" => round($m2,2),
                        "m2_total" => round($m2TT,2),
                        "design" => $product->design->nom_design,
                        "sku" => $product->code_sku,
                        "ean" => $product->gencode,
                        "taille" => $product->dimension->largeur."x".$product->dimension->longueur,
                        "stock" => $product->statsProduit->stock_restant,
                        "qte" => $import['qte'],
                        "url_image" => $product->photo->img_produit,
                     ],
                  ],
               ];
               $valider++;
            }else{
               $clients[$idArray]['products_tt'] = $clients[$idArray]['products_tt'] + $import['qte'];
               $clients[$idArray]['m2_tt'] = $clients[$idArray]['m2_tt'] + round($m2TT,2);
               $prix_TTC_client = round($clients[$idArray]["prix_ttc_tt"] + ($prix_TTC_unitaire * $import['qte']),2);
               $prixTVA_client = round($prixTTC_TT * 0.2,2);
               $prixHT_client = $prix_TTC_client - $prixTVA_client;

               $clients[$idArray]["prix_ttc_tt"] = $prix_TTC_client;
               $clients[$idArray]["prix_tva_tt"] = $prixTVA_client;
               $clients[$idArray]["prix_ht_tt"] = $prixHT_client;
               if(array_search($product->id_produit, array_column(array_column($clients, 'products'),'id_produit')) !== false){
                  $clients[$idArray]["products"]["qte"] = $clients[$idArray]["products"]["qte"] + $import['qte'];
                  $m2TT = $m2 * $clients[$idArray]["products"]["qte"];
                  $poidsTotal = $m2TT * $gamme->poids_m2_KG;

                  $clients[$idArray]["products"]["poids_total"] = $poidsTotal;
                  $clients[$idArray]["products"]["m2_total"] = $m2TT;
                  if($clients[$idArray]["products"]["qte"] >= $product->statsProduit->stock_restant){
                     $stockInvalid = true;
                     $clientProduitStockInvalide = true;
                     $clients[$idArray]["clientProduitStockInvalide"] = $clientProduitStockInvalide;
                  }
               }else{
                  $m2TT = $m2 * $import['qte'];
                  $poidsTotal = $m2TT * $gamme->poids_m2_KG;
                  $clients[$idArray]["products"][] = [
                     "id_produit" => $product->id_produit,
                     "prix_TTC_unitaire" => $prix_TTC_unitaire,
                     "gamme" => $gamme->nom_gamme,
                     "poids_unitaire" => round($poidsUnitaire,2),
                     "poids_total" => round($poidsTotal,2),
                     "m2_unitaire" => round($m2,2),
                     "m2_total" => round($m2TT,2),
                     "design" => $product->design->nom_design,
                     "sku" => $product->code_sku,
                     "ean" => $product->gencode,
                     "taille" => $product->dimension->largeur."x".$product->dimension->longueur,
                     "stock" => $product->statsProduit->stock_restant,
                     "qte" => $import['qte'],
                     "url_image" => $product->photo->img_produit,
                  ];
                  $clients[$idArray]["clientProduitStockInvalide"] = $clientProduitStockInvalide;
               }
               
            }
            $qteTT = $qteTT + $import['qte'];
            $m2Final = $m2Final + round($m2TT,2);
           
         }else{
            $erreur++;
            $clients[] = [
               'status' => false,
               'message' => 'Le produit avec le gencode : '.$eanProduct.' n\'a pas été trouver dans notre liste de produits !'
            ];
         }
      }

      $request->session()->put('importMarketplace',$clients);

      return ['valider'=>$valider,'erreur'=>$erreur,'importCommandes' => $clients,'qteFinal' => $qteTT,'m2Final' => $m2Final, 
      'prixHT_TT' => $prixHT_TT, 'prixTVA_TT' => $prixTVA_TT, 'prixTTC_TT' => $prixTTC_TT, 'stockInvalide' => $stockInvalid]; 
    }

    /**
     * Une fois valider cette fonction ajoute les clients d'un import par fichier 
     */
    public function validation_clients_fichier(Request $request){
      if(isset($request->clients) && !empty($request->clients)){
         $clients = $request->clients;
         $num_commande = PanierEdi::generateNumOrder();
         $panierMarketplace = PanierEdi::create([
            'date_ajout' => date('Y-m-d H:i:s'),
            'date_maj' => date('Y-m-d H:i:s'),
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
            'is_marketplace' => '1',
            'id_etape' => '1',
            'id_users' => Auth::user()->getAuthIdentifier(),
         ]);

         if(isset($panierMarketplace->id_panier_edi) && !empty($panierMarketplace->id_panier_edi)){
            foreach($clients as $client){
               if(count($client['products']) > 0){
                  $num_commande = ClientEdi::genNumCommande($panierMarketplace->id_panier_edi);
                  $clientMarketplace = ClientEDI::create([
                     'date_ajout' => date('Y-m-d H:i:s'),
                     'date_maj' => date('Y-m-d H:i:s'),
                     'nom' => $client['nom'],
                     'prenom' => $client['prenom'],
                     'email' => $client['adresse_facturation']['mail'],
                     'tel' => $client['adresse_livraison']['tel'],
                     'date_commande' => date('Y-m-d'),
                     'nom_adresse' => $client['adresse_livraison']['nom_adresse'],
                     'adresse1' => $client['adresse_livraison']['adresse1'],
                     'adresse2' => $client['adresse_livraison']['adresse2'],
                     'adresse3' => $client['adresse_livraison']['adresse3'],
                     'pays' => $client['adresse_livraison']['pays'],
                     'code_postal' => $client['adresse_livraison']['code_postal'],
                     'ville' => $client['adresse_livraison']['ville'],
                     'nom_adresse_facturation' => $client['adresse_facturation']['nom_adresse'],
                     'adresse1_facturation' => $client['adresse_facturation']['adresse1'],
                     'adresse2_facturation' => $client['adresse_facturation']['adresse2'],
                     'adresse3_facturation' => $client['adresse_facturation']['adresse3'],
                     'pays_facturation' => $client['adresse_facturation']['pays'],
                     'code_postal_facturation' => $client['adresse_facturation']['code_postal'],
                     'ville_facturation' => $client['adresse_facturation']['ville'],
                     'num_commande' => $num_commande,
                     'quantiter' => 0,
                     'poids' => 0,
                     'total_ht' => 0,
                     'total_taxe' => 0,
                     'total_ttc' => 0,
                     'total_m2' => 0,
                     'id_panier_edi' => $panierMarketplace->id_panier_edi
                  ]);
   
                  if(isset($clientMarketplace->id_panier_edi) && !empty($clientMarketplace->id_panier_edi)){
                     foreach($client['products'] as $product){
                        $stock = StatsProduit::where('id_produit','=',$product['id_produit'])->first();
                        if(isset($stock->stock_restant) && $stock->stock_restant > $product['qte']){
                           $prix_produit =  round(Produit::calcul_prix_produit($product['id_produit']),2);
                           $prix_TVA = round($prix_produit * 0.2,2);
                           $prix_ht = $prix_produit - $prix_TVA;
                           $prix_TTC_TT = round($prix_produit * $product['qte'],2);
                           $prix_TVA_TT = round($prix_TTC_TT * 0.2,2);
                           $prix_HT_TT = $prix_TTC_TT - $prix_TVA_TT;
                           PanierEdiList::create([
                              'date_ajout' => date('Y-m-d H:i:s'),
                              'date_maj' => date('Y-m-d H:i:s'),
                              'id_produit' => $product['id_produit'],
                              'prix_ht_unitaire' => $prix_ht,
                              'prix_taxe_unitaire' => $prix_TVA,
                              'prix_ttc_unitaire' => $prix_produit,
                              'quantiter' => $product['qte'],
                              'prix_ht_total' => $prix_HT_TT,
                              'prix_taxe_total' => $prix_TVA_TT,
                              'prix_ttc_total' => $prix_TTC_TT,
                              'id_client_edi' => $clientMarketplace->id_client_edi,
                           ]);
                        }
                     }
                     $panierGet = PanierEdi::find($panierMarketplace->id_panier_edi)->first();
                     if(isset($panierGet->id_panier_edi) && !empty($panierGet->id_panier_edi)){
                        $panierGet->nb_client = $panierGet->nb_client+1;
                        $panierGet->save();
                     } 

                     ClientEDI::calculPrixPanier($clientMarketplace->id_client_edi);
                  }

                  
               }
            }
            PanierEdi::calculPrixPanier($panierMarketplace->id_panier_edi);
            $panierGet = PanierEdi::with('client_edi_list')->where('id_panier_edi','=',$panierMarketplace->id_panier_edi)->first();
            $request->session()->put('panier_mkp',$panierGet);
         } 
         return Redirect::route('orders/clients/validation')->with(['status' => true, 'message' => 'Réussit !']);
      }else{
         return redirect()->back()->with(['status' => false, 'message' => 'Une erreur s\'est produite, veuillez recommencer l\'importation !']);
      }
    }   

    
    
   /**
    * Permet de rediriger avec les filtres de base de l'url
    * @return Redirect
    */
   public function create_redirect_product($gamme,Request $request){
      return redirect('/dropshipping/gamme'.'/'.$gamme.'?'.$request->getQueryString());
   }


   /**
    * Ajoute le produit à la commande du client
    */
    public function add_product_commande(Request $request) {
      
      $message = 'Une erreur c\'est produit lors de l\'ajout ou de la modification du panier du client.';
      $status = false;
      $id_panier_edi_list = 0;
      if(!empty($request->idProduit) && !empty($request->quantiter) && !empty($request->id_client_edi)){
         $client = ClientEDI::where('id_client_edi','=',$request->id_client_edi)->first();
         if(!empty($client->id_client_edi)){
            $stock = StatsProduit::where('id_produit','=',$request->idProduit)->first();
            if(isset($stock->stock_restant) && $stock->stock_restant > $request->quantiter) {
               if(isset($request->id_panier_edi_list) && !empty($request->id_panier_edi_list) && $request->id_panier_edi_list > 0){
                  $panierList = PanierEdiList::where('id_panier_edi_list','=',$request->id_panier_edi_list)->first();
                  if(isset($panierList->id_panier_edi_list) && !empty($panierList->id_panier_edi_list)){
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
               }else{
                  $produit = Produit::where('id_produit','=',$request->idProduit)->first();
                  if(!empty($produit->id_produit)){
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
         
                     if(isset($addProducts->id_panier_edi_list) && !empty($addProducts->id_panier_edi_list)){
                        PanierEdi::calculPrixPanier($client->id_panier_edi);
                        ClientEDI::calculPrixPanier($client->id_client_edi);
                        $status = true;
                     }
                  }
                  $request->session()->put('dynamique_client', ($request->session()->has('dynamique_client') ? intval($request->session()->get('dynamique_client'))+1 : 1));
               }
            }else{
               $message = 'La quantiter demander ne peux être fournis pour le moment, notre stock n\'est pas suffisant.';
         }
         }
        
      }
      
      return redirect()->back()->with(['status'=>$status,'message' => $message,'id_panier_edi_list'=>$id_panier_edi_list]);
    }

    /**
     * Suprimme le produit de la commande du client
     */
    public function delete_product_commande(Request $request) {
      $status = false;
      if(!empty($request->id_panier_edi_list) && !empty($request->id_panier_edi_list) && $request->id_panier_edi_list > 0){
         
         $panierList = PanierEdiList::where('id_panier_edi_list','=',$request->id_panier_edi_list)->first();
         if(isset($panierList->id_panier_edi_list) && !empty($panierList->id_panier_edi_list)){
            $client = ClientEDI::where('id_client_edi','=',$panierList->id_client_edi)->first();
            $panierList->forceDelete();
            PanierEdi::calculPrixPanier($client->id_panier_edi);
            ClientEDI::calculPrixPanier($client->id_client_edi);
            $status = true;
         }

         $request->session()->put('dynamique_client', ($request->session()->has('dynamique_client') ? intval($request->session()->get('dynamique_client'))-1 : 1));
      }

      return redirect()->back()->with(['status'=>$status]);
    }

    /**
    * Visualise les produits de la commande du client
    */
    public function view_product_commande(Request $request) {
      $client = $request->session()->get('client_actuel');
      $produitsAchat = new \stdClass;
      if(!empty($client)){
           $panierList = PanierEdiList::where('id_client_edi','=',$client->id_client_edi)->get();
               foreach($panierList as $list){
                  $produit = Produit::with(['photo','dimension','statsProduit','design','couleur'])->where('id_produit','=',$list->id_produit)->get();
                  for($i=0;$i<count($produit);$i++){
                     $produit[$i]->prix_produit = Produit::calcul_prix_produit($produit[$i]->id_produit);
                     $gamme = Gamme::where('id_gamme','=',$produit[$i]->design->id_gamme)->first();
                     $panier = PanierEdiList::where('id_produit','=',$produit[$i]->id_produit)->where('id_client_edi','=',$client->id_client_edi)->first();
                     $produit[$i]->gamme = $gamme;
                     $produit[$i]->panier = $panier;
                     $produit[$i]->isInPanier = true;
                     $produitsAchat->panier[] = $produit[$i];
                  }
               }
      }

      return ['produitsAchat' => $produitsAchat ];
    }

    /**
     * Permet de modifier la commande du client
     */
    public function edit_order_client(Request $request){
      if(isset($request->id_client_edi) && !empty($request->id_client_edi)){
          $clientGet = ClientEDI::where('id_client_edi','=',$request->id_client_edi)->first();
          $request->session()->put('client_actuel',$clientGet);
          return redirect()->back()->with(['status'=>true]);
      }else{
          return redirect()->back()->with(['status'=>false]);
      }
  }

  /**
   * Nous affiche la page de validation de la commande pour plusieur client 
   * 
   * @return \Inertia\Response
   */
    public function validation_commande_clients(Request $request){
      if($request->session()->has('panier_mkp')){
         $panierMarketplace = $request->session()->get('panier_mkp');
         $panier = PanierEdi::where('id_panier_edi','=',$panierMarketplace->id_panier_edi)->first();
         if(isset($panier->id_panier_edi) && !empty($panier->id_panier_edi) && !$panier->is_validate){
            $clients = ClientEDI::with(['panier_list','panier'])->where('id_panier_edi','=',$panierMarketplace->id_panier_edi)->get();
            $panier = PanierEdi::find($panierMarketplace->id_panier_edi);
            return Inertia::render('Auth/Pages/Orders/Clients/Validation', ['clients' => $clients,'panier' => $panier]);
         }else{
            return Redirect::route('orders/clients');
         }
        
      }else{
         return Redirect::route('home');
      }
      
    }

    /**
     * Récupére la commande du client 
     * 
     * @return stdClass
     */
    public function get_order_client(Request $request){
      $id_client_edi = $request->id_client_edi;
      $produits = new \stdClass;
      if(!empty($id_client_edi)){
         $panierList = PanierEdiList::where('id_client_edi','=',$id_client_edi)->get();
         foreach($panierList as $list){
            $produit = Produit::with(['photo','dimension','statsProduit'])->where('id_produit','=',$list->id_produit)->get();
            for($i=0;$i<count($produit);$i++){
               $panier = PanierEdiList::with('panier')->where('id_panier_edi_list','=',$list->id_panier_edi_list)->first();
               $produit[$i]->prixProduit = Produit::calcul_prix_produit($produit[$i]->id_produit);
               $produit[$i]->panier = $panier;
               $produit[$i]->id_client_edi = $request->id_client_edi;
               $produit[$i]->isInPanier = true;
               $produits->panier[] = $produit[$i];
            }
         }
      }
      $produits =  json_encode($produits);
      return $produits;
   }

   /**
    * Permet de confirmer la commande des clients en l'ajoutant aux commandes à préparer
    */
   public function confirmation_order_clients(Request $request){
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
    * Permet de réqupérer le contenue du panier Drop
    * @return Array
    */
   public function getPanierDrop(Request $request)
   {
      $panierCountF = 0;
      $produitsAchat = new \stdClass;
      if ($request->session()->has('typeVente') && $request->session()->get('typeVente') == 2) {
         if ($request->session()->has('panier_mkp') && !empty($request->session()->get('panier_mkp'))) {
            $panier = $request->session()->get('panier_mkp');
            $panierGet = PanierEdi::with('client_edi_list')->where('id_panier_edi', '=', $panier->id_panier_edi)->first();
            $produitsAchat->id_panier_edi = $panier->id_panier_edi;
            if (isset($panierGet->client_edi_list) && $panierGet->client_edi_list != null) {
               $clientList = (is_array($panierGet->client_edi_list) ? $panierGet->client_edi_list : array($panierGet->client_edi_list));
               for ($i = 0; $i < count($clientList); $i++) {
                  $id_client_edi = $clientList[$i]->id_client_edi;
                  $panierCount = PanierEdiList::where('id_client_edi', '=', $id_client_edi)->sum('quantiter');
                  $panierCountF = $panierCountF + $panierCount;
                  $panierList = PanierEdiList::with(["produit" => function ($query) {
                     $query->with(['photo', 'dimension', 'statsProduit', 'design' => function ($query2) {
                        $query2->with('gamme');
                     }, 'couleur']);
                  }])->where('id_client_edi', '=', $id_client_edi)->get();
                  $produits = array();
                  for ($j = 0; $j < count($panierList); $j++) {
                     $list = $panierList[$j];
                     $produit = $list->produit;
                     $gamme =  $produit->design->gamme;
                     $panier = PanierEdiList::with('panier')->where('id_panier_edi_list', '=', $list->id_panier_edi_list)->first();
                     $produit->prixProduit = Produit::calcul_prix_produit($produit->id_produit);
                     $produit->gamme = $gamme;
                     $produit->panier = $panier;
                     $produit->isInPanier = true;
                     array_push($produits, $produit);
                  }
                  $produitsAchat->clients[$i] = ["client" => $clientList[$i], "produits" => $produits, 'nbProduit' => $panierCount];
                  if ($request->session()->has('client_actuel')) {
                     $client = $request->session()->get('client_actuel');
                  } else {
                     $client = new \stdClass;
                  }
                  $produitsAchat->clientActuel = $client;
               }
            }
         }
      }
      return ['count' => $panierCountF, 'panier' => $produitsAchat];
   }
}
