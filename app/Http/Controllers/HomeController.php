<?php

namespace App\Http\Controllers;

use App\Models\Gamme;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        $user = User::with('client')->where('id','=',Auth::id())->first();
        //var_dump($user->taux_remise);

        $latestCollection = Gamme::latest('gamme.date_maj')
        ->where('gamme.in_edi', '=', '1')
        ->where('gamme.statut', '=', '1')
        ->leftJoin('client_edi_remise_gamme', function ($join) use ($user) {
            $join->on('client_edi_remise_gamme.id_gamme', '=', 'gamme.id_gamme')
                 ->where('client_edi_remise_gamme.id_client_edi', '=', $user->id_client);
        })
        ->orderBy('gamme.date_maj', 'asc')
        ->take(10)
        ->get();

        $latestCollection->each(function($latestCollection, $user){
            $remise = 0;
            if(isset($latestCollection->remiseGamme)){
                $remise = $latestCollection->remiseGamme;
            }
            elseif(isset($user->taux_remise)){
                $remise = $user->taux_remise;
            }

            if($remise > 0){
                $latestCollection->prix_vente_ht_m2_remise = "".round($latestCollection->prix_vente_ht_m2 * (1 - ($remise / 100)), 2) . "";
            }
            else{
                $latestCollection->prix_vente_ht_m2_remise = false;
            }
        });


        $bestSeller = Gamme::select('gamme.*', DB::raw('SUM(commande_list.quantite) as quantity_sold'))
        ->join('design', 'gamme.id_gamme', '=', 'design.id_gamme')
        ->join('produit', 'design.id_design', '=', 'produit.id_design')
        ->join('commande_list', 'produit.id_produit', '=', 'commande_list.id_produit')
        ->join('commande', 'commande_list.id_commande', '=', 'commande.id_commande')
        ->leftJoin('client_edi_remise_gamme', function ($join) use ($user) {
            $join->on('client_edi_remise_gamme.id_gamme', '=', 'gamme.id_gamme')
                 ->where('client_edi_remise_gamme.id_client_edi', '=', $user->id_client);
        })
        ->where('commande.date_commande', '>=', Carbon::now()->subYear())
        ->where('gamme.in_edi', '=', '1')
        ->where('gamme.statut', '=', '1')
        ->groupBy('gamme.id_gamme')
        ->orderByDesc('quantity_sold')
        ->take(10)
        ->get();

        $bestSeller->each(function($bestSeller, $user){
            $remise = 0;
            if(isset($bestSeller->remiseGamme)){
                $remise = $bestSeller->remiseGamme;
            }
            elseif(isset($user->taux_remise)){
                $remise = $user->taux_remise;
            }

            if($remise > 0){
                $bestSeller->prix_vente_ht_m2_remise = "".round($bestSeller->prix_vente_ht_m2 * (1 - ($remise / 100)), 2) . "";
            }
            else{
                $bestSeller->prix_vente_ht_m2_remise = false;
            }
        });
        
        
        return Inertia::render('Auth/Pages/Home',['latestCollection' => $latestCollection, 'bestSeller' => $bestSeller]);
    }
}
