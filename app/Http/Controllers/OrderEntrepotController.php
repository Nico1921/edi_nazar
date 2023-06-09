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
use App\Models\Photo;
use App\Models\PrixProduitSpecifique;
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


        $user = User::with('client')->where('id','=',Auth::id())->first();
        
        $products = QueryBuilder::for(Gamme::class)
            ->defaultSort('gamme.nom_gamme')
            ->distinct()
            ->select(['gamme.*','special.nom_special', 'client_edi_remise_gamme.remise AS remiseGamme',])
            ->join('special', 'special.id_special', 'gamme.id_special')
            ->leftJoin('client_edi_remise_gamme', function ($join) use ($user) {
                $join->on('client_edi_remise_gamme.id_gamme', '=', 'gamme.id_gamme')
                     ->where('client_edi_remise_gamme.id_client_edi', '=', $user->id_client);
            })
            ->leftJoin('prix_produit_specifique', function ($join) {
                $join->on('prix_produit_specifique.id_gamme', '=', 'gamme.id_gamme');
            })
            ->where('gamme.in_edi', '=', '1')
            ->where('gamme.statut', '=', '1')
            ->whereRaw('prix_produit_specifique.id_gamme IS NULL OR
            (SELECT COUNT(*) FROM produit WHERE gamme_id = gamme.id_gamme)
            = (SELECT COUNT(*) FROM prix_produit_specifique WHERE id_gamme = gamme.id_gamme)')
            ->allowedFilters([$gammeSearch])
            ->paginate((request('perPage') != "" ? request('perPage') : '12'))
            ->withQueryString();

            $products = Gamme::setRemiseGamme($products);
            $products = Gamme::setIfProduitPrixSpecifique($products);
        
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

        $user = User::with('client')->where('id','=',Auth::id())->first();

        $products = QueryBuilder::for(Gamme::class)
            ->defaultSort('gamme.nom_gamme')
            ->distinct()
            ->select(['gamme.*','special.nom_special', 'client_edi_remise_gamme.remise AS remiseGamme',])
            ->join('special', 'special.id_special', 'gamme.id_special')
            ->leftJoin('client_edi_remise_gamme', function ($join) use ($user) {
                $join->on('client_edi_remise_gamme.id_gamme', '=', 'gamme.id_gamme')
                     ->where('client_edi_remise_gamme.id_client_edi', '=', $user->id_client);
            })
            ->leftJoin('prix_produit_specifique', function ($join) {
                $join->on('prix_produit_specifique.id_gamme', '=', 'gamme.id_gamme');
            })
            ->where('gamme.in_edi', '=', '1')
            ->where('gamme.statut', '=', '1')
            ->whereRaw('prix_produit_specifique.id_gamme IS NULL OR
            (SELECT COUNT(*) FROM produit WHERE gamme_id = gamme.id_gamme)
            = (SELECT COUNT(*) FROM prix_produit_specifique WHERE id_gamme = gamme.id_gamme)')
            ->allowedFilters([$gammeSearch])
            ->paginate((request('perPage') != "" ? request('perPage') : '12'))
            ->withQueryString();

            $products = Gamme::setRemiseGamme($products);
            $products = Gamme::setIfProduitPrixSpecifique($products);


        // error_log(print_r($products));
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
        $user = User::with('client')->where('id','=',Auth::id())->first();

        $gammeSearch = DB::table('gamme')
        ->select(['gamme.*', 'client_edi_remise_gamme.remise AS remiseGamme'])
        ->leftJoin('client_edi_remise_gamme', function ($join) use ($user) {
            $join->on('client_edi_remise_gamme.id_gamme', '=', 'gamme.id_gamme')
                 ->where('client_edi_remise_gamme.id_client_edi', '=', $user->id_client);
        })
        ->where('nom_gamme', '=', $gamme)
        ->first();

        $check = PrixProduitSpecifique::where('id_gamme','=',$gammeSearch->id_gamme)->exists();
        if($check){
            $gammeSearch->prix_piece = true;
         }else{
            $gammeSearch->prix_piece = false;
         }


        //rajoute la remise si il y a une remise par client et gamme ou si il y a une remise par client global. sinon renvoie faux
        $gammeSearch->prix_vente_ht_m2_remise = isset($gammeSearch->remiseGamme)?"".round($gammeSearch->prix_vente_ht_m2 * (1 - ($gammeSearch->remiseGamme / 100)), 2) . "":(isset($user->client->taux_remise)?"".round($gammeSearch->prix_vente_ht_m2 * (1 - ($user->client->taux_remise / 100)), 2) . "":false);
        
        $designpanier = DB::table('design')
            ->select(['gamme.id_gamme','design.nom_design','design.id_design'])
            ->distinct()
            ->join('gamme', 'gamme.id_gamme', 'design.id_gamme')
            ->join('produit', 'produit.id_design', 'design.id_design')
            ->where('gamme.in_edi', '=', '1')
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

        $design = new \stdClass;

        if (!empty($clientUser)) {
            for ($i = 0; $i < count($designpanier); $i++) {
                $design->$i = new \stdClass;
                $design->$i->produits = new \stdClass;

                $photo = Produit::select('produit.id_produit')->with(['photo' => function($query) {
                    $query->where('principale_edi', '=', '1');
                }])
                ->join('photo','photo.id_produit','produit.id_produit')
                ->where('produit.code_sku', '!=', 'null')
                ->where('produit.code_sku', '!=', '""')
                ->where('produit.drop_shipping', '=', '1')
                ->where('produit.statut', '=', '1')
                ->where('photo.principale_edi', '=', '1')
                ->where('id_design','=',$designpanier[$i]->id_design)->first();
                if($photo === null){
                    $photo = Produit::select('id_produit')->with(['photo' => function($query) {
                        $query->where('principale', '=', '1');
                    }])
                    ->where('produit.code_sku', '!=', 'null')
                    ->where('produit.code_sku', '!=', '""')
                    ->where('produit.drop_shipping', '=', '1')
                    ->where('produit.statut', '=', '1')
                    ->where('id_design','=',$designpanier[$i]->id_design)->first();
                }
                $design->$i->nom_design = $designpanier[$i]->nom_design;
                $design->$i->img_produit = ($photo != null && $photo->photo != null ? $photo->photo->img_produit : '');
                if($photo != null && $photo->photo != null && isset($photo->id_produit)){
                    $photos = Photo::where('id_produit','=',$photo->id_produit)->get();
                    $design->$i->img_produit_list = $photos;
                }else{
                    $design->$i->img_produit_list = [];
                }

                $produit = Produit::with(['dimension','statsProduit','photo' => function($query) {
                    $query->where('principale', '=', '1');
                }])
                ->join('dimension','produit.id_dimension','dimension.id_dimension')
                ->where('produit.code_sku', '!=', 'null')
                ->where('produit.code_sku', '!=', '""')
                ->where('produit.drop_shipping', '=', '1')
                ->where('produit.statut', '=', '1')
                ->where('id_design', '=', $designpanier[$i]->id_design)
                ->orderBy('dimension.largeur', 'asc')
                ->orderBy('dimension.longueur', 'asc')
                ->get();
                for ($j = 0; $j < count($produit); $j++) {
                    $design->$i->produits->$j = new \stdClass;
                    $design->$i->produits->$j->prixProduit = Produit::calcul_prix_produit($produit[$j]->id_produit,0);
                    $design->$i->produits->$j->largeur = $produit[$j]->dimension->largeur;
                    $design->$i->produits->$j->longueur = $produit[$j]->dimension->longueur;
                    $design->$i->produits->$j->stock_restant = $produit[$j]->statsProduit->stock_restant;
                    $design->$i->produits->$j->sku = $produit[$j]->code_sku;
                    $design->$i->produits->$j->id_produit = $produit[$j]->id_produit;
                    $design->$i->produits->$j->photo_produit = ($produit[$j]->photo != null ? $produit[$j]->photo : null);
                    if (PanierEdiList::where('id_produit', '=', $produit[$j]->id_produit)->where('id_client_edi', '=', $clientUser->id_client_edi)->exists()) {
                        $panier = PanierEdiList::where('id_produit', '=', $produit[$j]->id_produit)->where('id_client_edi', '=', $clientUser->id_client_edi)->first();
                        $design->$i->produits->$j->panier= $panier;
                        $design->$i->produits->$j->isInPanier = true;
                    } else {
                        $design->$i->produits->$j->panier= array("quantiter" => 0);
                        $design->$i->produits->$j->isInPanier = false;
                    }
                }

                
            }
        } else {
            for ($i = 0; $i < count($designpanier); $i++) {
                $design->$i = new \stdClass;
                $design->$i->produits = new \stdClass;

                $photo = Produit::select('produit.id_produit')->with(['photo' => function($query) {
                    $query->where('principale_edi', '=', '1');
                }])
                ->join('photo','photo.id_produit','produit.id_produit')
                ->where('produit.code_sku', '!=', 'null')
                ->where('produit.code_sku', '!=', '""')
                ->where('produit.drop_shipping', '=', '1')
                ->where('produit.statut', '=', '1')
                ->where('photo.principale_edi', '=', '1')
                ->where('id_design','=',$designpanier[$i]->id_design)->first();
                if($photo === null){
                    $photo = Produit::select('id_produit')->with(['photo' => function($query) {
                        $query->where('principale', '=', '1');
                    }])
                    ->where('produit.code_sku', '!=', 'null')
                    ->where('produit.code_sku', '!=', '""')
                    ->where('produit.drop_shipping', '=', '1')
                    ->where('produit.statut', '=', '1')
                    ->where('id_design','=',$designpanier[$i]->id_design)->first();
                }
                $design->$i->nom_design = $designpanier[$i]->nom_design;
                $design->$i->img_produit = ($photo != null && $photo->photo != null ? $photo->photo->img_produit : '');
                if($photo != null && $photo->photo != null && isset($photo->id_produit)){
                    $photos = Photo::where('id_produit','=',$photo->id_produit)->get();
                    $design->$i->img_produit_list = $photos;
                }else{
                    $design->$i->img_produit_list = [];
                }
                
                $produit = Produit::with(['dimension','statsProduit','photo' => function($query) {
                    $query->where('principale', '=', '1');
                }])
                ->join('dimension','produit.id_dimension','dimension.id_dimension')
                ->where('produit.code_sku', '!=', 'null')
                ->where('produit.code_sku', '!=', '""')
                ->where('produit.drop_shipping', '=', '1')
                ->where('produit.statut', '=', '1')
                ->where('id_design', '=', $designpanier[$i]->id_design)
                ->orderBy('dimension.largeur', 'asc')
                ->orderBy('dimension.longueur', 'asc')
                ->get();

                for ($j = 0; $j < count($produit); $j++) {
                    $design->$i->produits->$j = new \stdClass;
                    $design->$i->produits->$j->prixProduit = Produit::calcul_prix_produit($produit[$j]->id_produit,0);
                    $design->$i->produits->$j->largeur = $produit[$j]->dimension->largeur;
                    $design->$i->produits->$j->longueur = $produit[$j]->dimension->longueur;
                    $design->$i->produits->$j->stock_restant = $produit[$j]->statsProduit->stock_restant;
                    $design->$i->produits->$j->sku = $produit[$j]->code_sku;
                    $design->$i->produits->$j->id_produit = $produit[$j]->id_produit;
                    $design->$i->produits->$j->photo_produit = ($produit[$j]->photo != null ? $produit[$j]->photo : null);
                    $design->$i->produits->$j->panier = array("quantiter" => 0);
                    $design->$i->produits->$j->isInPanier = false;
                }
                
            }
        }

        return Inertia::render('Auth/Pages/Products/Gamme', [
            'gamme' => $gammeSearch,
            'designpanier' => $design
        ]);
    }

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

    public function create_redirect_product($gamme,Request $request){
        return redirect('/order_entrepot/gamme'.'/'.$gamme.'?'.$request->getQueryString());
    }

    public function getProductsDesign(Request $request)
    {
        $id_design = $request->post()['id_design'];
        if ($request->session()->has('client_commercial')) {
            $clientUser = $request->session()->get('client_commercial');
        } else {
            $clientUser = array();
        }
        $sort = 'asc';
        $produits = array();
        $produits = Produit::with(['photo', 'dimension' => function($query) use ($sort) {
            $query->orderBy('largeur',$sort);
        }, 'statsProduit'])->join('dimension','dimension.id_dimension','=','produit.id_dimension')->orderBy('dimension.largeur',$sort)->orderBy('dimension.longueur',$sort)->where('id_design', '=', $id_design)->get();
        if (!empty($clientUser)) {
            for ($i = 0; $i < count($produits); $i++) {
                $produits[$i]->prixProduit = Produit::calcul_prix_produit($produits[$i]->id_produit,0);
                if (PanierEdiList::where('id_produit', '=', $produits[$i]->id_produit)->where('id_client_edi', '=', $clientUser->id_client_edi)->exists()) {
                    $panier = PanierEdiList::where('id_produit', '=', $produits[$i]->id_produit)->where('id_client_edi', '=', $clientUser->id_client_edi)->first();
                    $produits[$i]->panier = $panier;
                    $produits[$i]->isInPanier = true;
                } else {
                    $produits[$i]->panier = array("quantiter" => 0);
                    $produits[$i]->isInPanier = false;
                }
            }
        } else {
            for ($i = 0; $i < count($produits); $i++) {
                $produits[$i]->prixProduit = Produit::calcul_prix_produit($produits[$i]->id_produit,0);
                $produits[$i]->panier = array("quantiter" => 0);
                $produits[$i]->isInPanier = false;
            }
        }


        return $produits;
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
                $user = User::with(['client'])->where('id','=',Auth::user()->getAuthIdentifier())->first();
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
                    //refresh prix produit
                    $produit = Produit::where('id_produit', '=', $request->idProduit)->first();
                    $prix_ttc_unitaire = round(round(Produit::calcul_prix_produit($produit->id_produit,1),3),2);

                    $prix_TTC_TT = round($prix_ttc_unitaire * $request->quantiter,2);
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
                $message = "Votre panier a déjà été validé, vous pouvez aller dans la section 'Expéditions' pour voir les détails de votre commande.";
            }else{
                $message = "Une erreur s'est produite lors de l'ajout du produit."; 
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
                    $message = "Votre panier a déjà été validé, vous pouvez aller dans la section 'Expéditions' pour voir les détails de votre commande.";
                }else{
                    $message = "Une erreur s'est produite lors de la suppression du produit du panier."; 
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
                $user = User::with(['client'])->where('id','=',Auth::user()->getAuthIdentifier())->first();
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
                            $prix_produit = round(round(Produit::calcul_prix_produit($product->id_produit,1),3),2);
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
