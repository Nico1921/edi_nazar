<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|confirmed|max:255|unique:connexion_edi',
            'tel' => 'required|numeric|phone:AUTO,FR',
            'nom_societe' => 'required|string|max:255',
            'numTVA' => 'required|string|max:32',
            'adresse' => 'required|string|max:32',
            'pays' => 'required|country_name',
            'cp' => 'required|postal_code:pays',
            'ville' => 'required|string|max:32',
            'nameFileKbis' => 'required|string|max:150',
            'nameFileIdentiter' => 'required|string|max:150',
        ]);

        $statut = false;
        $message = '';
        try{
            Client::create([
                'contact' => $request->nom." ".$request->prenom,
                'email' => $request->email,
                'tel1' => $request->tel,
                'nom_societe' => $request->nom_societe,
                'tva_intra' => $request->numTVA,
                'adresse1' => $request->adresse,
                'adresse2' => "",
                'adresse3' => "",
                'code_postal' => $request->cp,
                'ville' => $request->ville,
                'pays' => $request->pays,
                'url_client' =>  str_replace(' ', '-',$request->nom_societe),
                'date_ajout' => date('Y-m-d H:i'),
                'id_user' => 0,
                'num_client' => 0,
                'is_client' => 1,
                'is_fournisseur' => 0,
                'is_validate' => 0,
                'is_edi' => 1,
                'path_kbis' => $request->nameFileKbis,
                'path_identiter' => $request->nameFileIdentiter
            ]);
            $statut = true;
            $message = 'Votre inscription a bien été prise en compte et sera traitée par nos équipes dans les meilleurs délais. Une fois validée, vous recevrez vos identifiants par e-mail.';
        }   catch(\Exception $e) {
            $statut = false;
            $message = 'Une erreur s\'est produite lors de votre demande d\'inscription, veuillez réessayer plus tard !';
        }
        
        return Inertia::render('Auth/Register',['sendMessage' => $statut,'messageValidation' => $message]);
        // return redirect()->route('register')->with('message', 'Category Created Successfully');
    }

    public function uploadKbis(Request $request){
            
        $request->validate([
           'fileKbis' => 'required|mimes:jpg,jpeg,png,pdf|max:8048'
        ]);

        
        if($request->file()) {
            $fileUpload = $request->file('fileKbis');
            $fileName = 'Kbis_'.date('Y-m-d-H-m-s').'.'.$fileUpload->extension();
            $fileUpload->storeAs('/uploads/kbis',$fileName,'public');

            return response()->json(['success'=>'Fichier téléversé avec succès.','fileName' => $fileName]);
        }
   }

   public function uploadIdentiter(Request $request){
            
    $request->validate([
       'fileIdentiter' => 'required|mimes:jpg,jpeg,png,pdf|max:8048'
    ]);

    
    if($request->file()) {
        $fileUpload = $request->file('fileIdentiter');
        $fileName = 'Identiter_'.date('Y-m-d-H-m-s').'.'.$fileUpload->extension();
        $fileUpload->storeAs('/uploads/identiter',$fileName,'public');

        return response()->json(['success'=>'Fichier téléversé avec succès.','fileName' => $fileName]);
    }
}
}
