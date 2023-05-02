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
        //var_dump($user->taux_remise);

        $latestCollection = Gamme::getRequestGammeCaracteristiques()
        ->latest('gamme.date_maj')
        ->where('gamme.statut', '=', '1')
        ->orderBy('gamme.date_maj', 'asc')
        ->take(10)
        ->get();

        //var_dump($latestCollection);

        $latestCollection = Gamme::setRemiseGamme($latestCollection); 


        $bestSeller = Gamme::getRequestGammeCaracteristiques()
        ->select('gamme.*', DB::raw('SUM(commande_list.quantite) as quantity_sold'), 'client_edi_remise_gamme.remise as remiseGamme')
        ->join('produit', 'gamme.id_gamme', '=', 'produit.gamme_id')
        ->join('commande_list', 'produit.id_produit', '=', 'commande_list.id_produit')
        ->join('commande', 'commande_list.id_commande', '=', 'commande.id_commande')
        ->where('commande.date_commande', '>=', Carbon::now()->subYear())
        ->where('gamme.statut', '=', '1')
        ->groupBy('gamme.id_gamme')
        ->orderByDesc('quantity_sold')
        ->take(10)
        ->get();

        
        $bestSeller = Gamme::setRemiseGamme($bestSeller); 
        
        
        return Inertia::render('Auth/Pages/Home',['latestCollection' => $latestCollection, 'bestSeller' => $bestSeller]);
    }
}
