<?php
namespace App\Http\Controllers;

use App\Models\ClientEDI;
use App\Models\Commande;
use App\Models\CommandeMarketplace;
use App\Models\Gamme;
use App\Models\Produit;
use App\Models\PanierEdi;
use App\Models\PanierEdiList;
use App\Models\Photo;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Collection;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ShippingsController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {

        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('panier_edi.num_commande', 'LIKE', "%{$value}%")
                        ->orWhere('panier_edi.date_commande', 'LIKE', "%{$value}%");
                });
            });
        });

        $panierEdi = QueryBuilder::for(PanierEdi::class)
        ->defaultSort('date_commande')
        ->select(['panier_edi.id_panier_edi','panier_edi.date_commande','panier_edi.date_maj','panier_edi.num_commande','panier_edi.nb_client',
        'panier_edi.total_HT','panier_edi.total_ttc','panier_edi.poids_total','panier_edi.produits_total',
        'panier_edi.total_m2','panier_edi.date_livraison','panier_edi.total_payer','panier_edi.is_validate','panier_edi.is_marketplace'])
        ->allowedSorts(['date_livraison','date_commande','num_commande','produits_total','total_m2','poids_total','total_ttc','is_marketplace','total_HT'])
        ->allowedFilters([$globalSearch,'date_livraison','date_commande','num_commande','total_ttc'])
        ->where('id_users','=',Auth::id())
        ->paginate(request('perPage'))
        ->withQueryString();

        // error_log(print_r($products));
        return Inertia::render('Auth/Pages/Shippings', [
            'panierEdi' => $panierEdi,
        ])->table(function (InertiaTable $table) {
            $table
              ->withGlobalSearch()
              ->defaultSort('date_commande')
              ->column(key: 'num_commande',label: 'N° Commande', searchable: true, sortable: false, canBeHidden:false)
              ->column(key: 'nb_client',label: 'clients', searchable: false, sortable: false, canBeHidden:true)
              ->column(key: 'date_commande',label: 'Date commande', searchable: true, sortable: true, canBeHidden:false)
              ->column(key: 'produits_total',label: 'Total produit', searchable: true, sortable: true, canBeHidden:true)
              ->column(key: 'poids_total',label: 'Poids Total', searchable: true, sortable: true, canBeHidden:true)
              ->column(key: 'total_m2',label: 'Total m²', searchable: true, sortable: true, canBeHidden:true)
              ->column(key: 'total_HT',label: 'Total HT', searchable: true, sortable: true, canBeHidden:true)
              ->column(key: 'date_livraison',label: 'Date livraison estimer', searchable: false, sortable: true, canBeHidden:true)
              ->column(key: 'is_validate',label: 'Statut commande', searchable: false, sortable: false, canBeHidden:true)
              ->column(key: 'is_marketplace',label: 'Type Commande', searchable: false, sortable: true, canBeHidden:true)
              ->column(label: 'Action', searchable: false, sortable: false, canBeHidden:false)
              ;});
    }

    public function edit_commande(Request $request){
        if(isset($request->id_panier_edi) && !empty($request->id_panier_edi)){
            $request->session()->put('typeVente', 2);
            $panierGet = PanierEdi::with('client_edi_list')->where('id_panier_edi','=',$request->id_panier_edi)->first();
            $request->session()->put('panier_mkp',$panierGet);
            $clientGet = ClientEDI::with('panier')->where('id_panier_edi','=',$request->id_panier_edi)->first();
            $request->session()->put('client_actuel',$clientGet);
            return true;
        }else{
            return false;
        }
    }

    public function delete_commande(Request $request){
        $status = false;
        if(!empty($request->id_panier_edi) && !empty($request->id_panier_edi) && $request->id_panier_edi > 0){
           $panierEdi = PanierEdi::where('id_panier_edi','=',$request->id_panier_edi)->first();
           if(isset($panierEdi->id_panier_edi) && !empty($panierEdi->id_panier_edi)){
              PanierEdiList::join('client_edi','panier_edi_list.id_client_edi','=','client_edi.id_client_edi')->where('client_edi.id_panier_edi','=',$panierEdi->id_panier_edi)->forceDelete();
              ClientEDI::where('id_panier_edi','=',$panierEdi->id_panier_edi)->forceDelete();
              PanierEdi::where('id_panier_edi','=',$panierEdi->id_panier_edi)->forceDelete();
              $status = true;
           }
        }
  
        return redirect()->back()->with(['status'=>$status]);
    }

    public function edit_panier(Request $request){
        if(isset($request->id_panier_edi) && !empty($request->id_panier_edi)){
            $request->session()->put('typeVente', 1);
            $panierGet = PanierEdi::with('client_edi_list')->where('id_panier_edi','=',$request->id_panier_edi)->first();
            $request->session()->put('panier_commercial',$panierGet);
            $request->session()->put('client_commercial',$panierGet->client_edi_list[0]);
            
            return true;
        }else{
            return false;
        }
    }

    public function create_order(Request $request){
        if(!empty($request->num_commande)){
            $order = PanierEdi::where('num_commande','=',$request->num_commande)->where('id_users','=', Auth::id())->first();
            if(isset($order->id_panier_edi) && !empty($order->id_panier_edi)){
                $clients = ClientEDI::where('id_panier_edi','=',$order->id_panier_edi)->get();
                if(!empty($clients) && count($clients) > 0){
                    $dataReturn = array();
                    if($order->is_marketplace == 1 ){
                        $dataReturn = [
                            'order' => $order,
                            'clients' => $clients
                        ];
                    }else{
                        $id_client_edi = $clients[0]->id_client_edi;
                        $produits = new \stdClass;
                        if(!empty($id_client_edi)){
                        $panierList = PanierEdiList::where('id_client_edi','=',$id_client_edi)->get();
                        foreach($panierList as $list){
                            $panierG = PanierEdi::where('id_panier_edi','=',$list->panier->id_panier_edi)->first();
                            $produit = Produit::with(['photo','dimension','statsProduit'])->where('id_produit','=',$list->id_produit)->get();
                            for($i=0;$i<count($produit);$i++){
                                $panier = PanierEdiList::with('panier')->where('id_panier_edi_list','=',$list->id_panier_edi_list)->first();
                                $client = ClientEDI::where('id_client_edi','=',$id_client_edi)->first();
                                $commande = Commande::where('num_commande_interne','=',$client->num_commande)->first();
                                $produit[$i]->panier = $panier;
                                $produit[$i]->panierG = $panierG;
                                $produit[$i]->commande = $commande;
                                $produit[$i]->isInPanier = true;
                                $produits->panier[] = $produit[$i];
                            }           
                        }        
                        }
                        $dataReturn = [
                            'order' => $order,
                            'clients' => $clients[0],
                            'produits' => $produits,
                        ];
                    }
                    return Inertia::render('Auth/Pages/Shippings/Orders',$dataReturn);
                }else{
                    abort(500);
                }
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }


    /**
     * Récupére la commande du client mkp 
     * 
     * @return stdClass
     */
    public function get_order_client(Request $request){
        $id_client_edi = $request->id_client_edi;
        $produits = new \stdClass;
        if(!empty($id_client_edi)){
           $panierList = PanierEdiList::with('panier')->where('id_client_edi','=',$id_client_edi)->get();
           foreach($panierList as $list){
              $panierG = PanierEdi::where('id_panier_edi','=',$list->panier->id_panier_edi)->first();
              $produit = Produit::with(['photo','dimension','statsProduit'])->where('id_produit','=',$list->id_produit)->get();
              for($i=0;$i<count($produit);$i++){
                 $panier = PanierEdiList::with('panier')->where('id_panier_edi_list','=',$list->id_panier_edi_list)->first();
                 $client = ClientEDI::where('id_client_edi','=',$id_client_edi)->first();
                 $commande = CommandeMarketplace::with(['etape','commande_stock'])->where('ref_externe','=',$client->num_commande)->first();
                 $produit[$i]->panier = $panier;
                 $produit[$i]->panierG = $panierG;
                 $produit[$i]->commande = $commande;
                 $produit[$i]->isInPanier = true;
                 $produits->panier[] = $produit[$i];
              }           
           }        
        }
        $produits =  json_encode($produits);
        return $produits;
     }

     /**
     * Récupére la commande du client  
     * 
     * @return stdClass
     */
    public function get_order_clientCom(Request $request){

        $id_client_edi = $request->id_client_edi;
        $produits = new \stdClass;
        if(!empty($id_client_edi)){
           $panierList = PanierEdiList::where('id_client_edi','=',$id_client_edi)->get();
           foreach($panierList as $list){
              $produit = Produit::with(['photo','dimension','statsProduit'])->where('id_produit','=',$list->id_produit)->get();
              for($i=0;$i<count($produit);$i++){
                 $panier = PanierEdiList::with('panier')->where('id_panier_edi_list','=',$list->id_panier_edi_list)->first();
                 $client = ClientEDI::where('id_client_edi','=',$id_client_edi)->first();
                 $commande = Commande::where('ref_externe','=',$client->num_commande)->first();
                 $produit[$i]->panier = $panier;
                 $produit[$i]->commande = $commande;
                 $produit[$i]->isInPanier = true;
                 $produits->panier[] = $produit[$i];
              }           
           }        
        }
        $produits =  json_encode($produits);
        return $produits;
    }

    /**
     * Permet la génération d'un ZIP avec toute les images lier à la commande
     */
    public function get_visuel_order_zip(Request $request){
        if(!empty($request->num_commande)){
            $panier = PanierEdi::where('num_commande','=',$request->num_commande)->first();
            if(!empty($panier->id_panier_edi)){
                $zipName = 'visuel_commande_'.$request->num_commande.'.zip';
                $zipVisual = new \ZipArchive();
                $zipVisual->open(storage_path('tmp/'.$zipName) , \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
                $clientList = ClientEDI::where('id_panier_edi','=', $panier->id_panier_edi)->get();
                if(count($clientList) > 0){
                    foreach($clientList as $client){
                        $panierList = PanierEdiList::where('id_client_edi','=',$client->id_client_edi)->get();
                        if(count($panierList) > 0){
                            foreach($panierList as $lePanier){
                                $photos = Photo::where('id_produit','=',$lePanier->id_produit)->get();
                                if(count($photos) > 0){
                                    foreach($photos as $photo){
                                        $produit = Produit::with(['design'])->where('id_produit','=',$lePanier->id_produit)->first();
                                        $gamme = Gamme::where('id_gamme','=',$produit->design->id_gamme)->first();
                                        
                                        $pathOriginalFile = 'https://gestion.tapis-nazar.fr/img/produit/'.$photo->img_produit;
                                        if(curl_init($pathOriginalFile) !== false) {
                                            $pathFile = $gamme->nom_gamme."/".$produit->design->nom_design."/".$photo->img_produit;
                                            $zipVisual->addFromString($pathFile, file_get_contents($pathOriginalFile));
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $zipVisual->close();

                 // Set Header
                $headers = array(
                    'Content-Type' => 'application/octet-stream',
                );
                return response()->download(storage_path('tmp/'.$zipName),$zipName,$headers);
            }
        }
    }
}
