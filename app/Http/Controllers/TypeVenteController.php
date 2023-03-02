<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TypeVenteController extends Controller
{
   /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/TypeVente');
    }

    public function choix_entrepot(Request $request){
        $request->session()->put('typeVente', 1);
        return redirect('/');
    }

    public function choix_clients(Request $request){
        $request->session()->put('typeVente', 2);
        return redirect('/');
    }
}
