<?php

namespace App\Http\Controllers;

use App\Models\Gamme;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        $latestCollection = Gamme::latest('date_maj')->where('gamme.in_edi', '=', '1')->where('gamme.statut', '=', '1')->orderby('date_maj','asc')->take(10)->get();
        $bestSeller = Gamme::select('gamme.*', DB::raw('SUM(commande_list.quantite) as quantity_sold'))
        ->join('design', 'gamme.id_gamme', '=', 'design.id_gamme')
        ->join('produit', 'design.id_design', '=', 'produit.id_design')
        ->join('commande_list', 'produit.id_produit', '=', 'commande_list.id_produit')
        ->join('commande', 'commande_list.id_commande', '=', 'commande.id_commande')
        ->where('commande.date_commande', '>=', Carbon::now()->subYear())
        ->where('gamme.in_edi', '=', '1')
        ->where('gamme.statut', '=', '1')
        ->groupBy('gamme.id_gamme')
        ->orderByDesc('quantity_sold')
        ->take(10)
        ->get();
        
        return Inertia::render('Auth/Pages/Home',['latestCollection' => $latestCollection, 'bestSeller' => $bestSeller]);
    }
}
