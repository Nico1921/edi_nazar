<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\StatsProduit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SettingsController extends Controller
{
   /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Pages/User/Settings');
    }

    public function edit_general(Request $request){
        $request->validate([
            'contact' => 'required|string|max:255',
            'tel' => 'required|numeric|phone:AUTO,FR',
        ]);

        $status = false;

        $user = User::with(['client'])->where('id','=',Auth::user()->getAuthIdentifier())->first();
        if(isset($user->id) && !empty($user->id)){
            $client = Client::where('id_client','=',$user->client->id_client)->first();
            if(isset($client->id_client) && !empty($client->id_client)){
                $client->contact = $request->contact;
                $client->tel1 = $request->tel;
                $client->save();
                $status = true;
            }
        }

        return redirect()->back()->with('status',$status);
    }

    public function edit_profil(Request $request){
        $request->validate(['profil' => 'required|file|mimes:jpg,jpeg,png']);

        $status = false;
        $image = '';

        $user = User::with(['client'])->where('id','=',Auth::user()->getAuthIdentifier())->first();
        if(isset($user->id) && !empty($user->id)){
            $image = base64_encode(file_get_contents($request->file('profil')->path()));
            if(base64_decode($image)){
                $user->img_profil = $image;
                $user->save();
                $status = true;
            }
        }

        return redirect()->back()->with(['status' => $status , 'imgBase64' => $image]);
    }

    public function edit_secu(Request $request){
        $user = User::with(['client'])->where('id','=',Auth::user()->getAuthIdentifier())->first();
        $validate = array();
        $status = false;
        $message = '';
        if(isset($user->id) && !empty($user->id)){
            if($request->email != $user->email || !empty($request->actualPassword)){
                if($request->email != $user->email){
                    $validate['email'] = 'required|string|email|confirmed|max:255|unique:connexion_edi';
                }
    
                if(!empty($request->actualPassword)){
                    $validate['actualPassword'] = 'required|current_password';
                    $validate['password'] = 'required|confirmed';
                }
                $request->validate($validate);
                
                
        
                if($request->email != $user->email){
                    $client = Client::where('id_client','=',$user->client->id_client)->first();
                    if(isset($client->id_client) && !empty($client->id_client)){
                            $client->email = $request->email;
                            $client->save();
                    }
                    $user->email = $request->email;
                    $user->save();
                    $status = true;
                }
    
                if(!empty($request->actualPassword)){
                    $newPassword = Hash::make($request->password);
                    $user->password = $newPassword;
                    $user->save();
                    $status = true;
                }            
            }else{
                $message = "Aucune modification à apporter !";
            }   
        }
        
        return redirect()->back()->with(['status' => $status,'message' => $message]);
    }

    public function edit_societe(Request $request){
        $request->validate([
            'adresse' => 'required|string|max:32',
            'pays' => 'required|country_name',
            'cp' => 'required|postal_code:pays',
            'ville' => 'required|string|max:32',
        ]);

        $status = false;

        $user = User::with(['client'])->where('id','=',Auth::user()->getAuthIdentifier())->first();
        if(isset($user->id) && !empty($user->id)){
            $client = Client::where('id_client','=',$user->client->id_client)->first();
            if(isset($client->id_client) && !empty($client->id_client)){
                $client->adresse1 = $request->adresse;
                $client->pays = $request->pays;
                $client->code_postal = $request->cp;
                $client->ville = $request->ville;
                $client->save();
                $status = true;
            }
        }

        return redirect()->back()->with('status',$status);
    }

    public function edit_sociaux(Request $request){
        $request->validate([
            'social_twitter' => 'nullable|string|max:155',
            'social_insta' => 'nullable|string|max:155',
            'social_facebook' => 'nullable|string|max:155',
            'social_linkedin' => 'nullable|string|max:155',
            'social_website' => 'nullable|string|max:250',
        ]);

        $status = false;

        $user = User::with(['client'])->where('id','=',Auth::user()->getAuthIdentifier())->first();
        if(isset($user->id) && !empty($user->id)){
            $client = Client::where('id_client','=',$user->client->id_client)->first();
            if(isset($client->id_client) && !empty($client->id_client)){
                $client->social_twitter = $request->social_twitter;
                $client->social_insta = $request->social_insta;
                $client->social_facebook = $request->social_facebook;
                $client->social_linkedin = $request->social_linkedin;
                $client->social_website = $request->social_website;
                $client->save();
                $status = true;
            }
        }

        return redirect()->back()->with('status',$status);
    }

    public function exportStockCsv(Request $request){
        $user = User::with(['client'])->where('id','=',Auth::user()->getAuthIdentifier())->first();
        $fileName = 'Stock_Nazar_'.strtolower(trim(preg_replace('#\W+#', '_', $user->client->nom_societe), '_')).'.csv';

        $stocks = StatsProduit::select([
            'stats_produit.stock_restant',
            'gamme.nom_gamme',
            'couleur.nom_couleur',
            'dimension.largeur',
            'dimension.longueur',
            'produit.code_sku',
            'produit.gencode'])
            ->join('produit','produit.id_produit','=','stats_produit.id_produit')
            ->join('gamme','gamme.id_gamme','=','produit.gamme_id')
            ->leftJoin('prix_produit_specifique', function ($join) {
                $join->on('prix_produit_specifique.id_gamme', '=', 'gamme.id_gamme');
            })
            ->leftJoin('dimension', function ($join) {
                $join->on('dimension.id_dimension', '=', 'produit.id_dimension');
            })
            ->leftJoin('couleur', function ($join) {
                $join->on('couleur.id_couleur', '=', 'produit.id_couleur');
            })
            ->where('gamme.in_edi', '=', '1')
            ->where('gamme.statut', '=', '1')
            ->whereRaw('prix_produit_specifique.id_gamme IS NULL OR
            (SELECT COUNT(*) FROM produit WHERE gamme_id = gamme.id_gamme)
            = (SELECT COUNT(*) FROM prix_produit_specifique WHERE id_gamme = gamme.id_gamme)')
            ->where('produit.code_sku', '!=', 'null')
            ->where('produit.code_sku', '!=', '""')
            ->where('produit.drop_shipping', '=', '1')
            ->where('produit.statut', '=', '1')
            ->orderBy('gamme.nom_gamme','ASC')
            ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('GAMME', 'SKU', 'GENCODE', 'DIMENSION', 'COULEUR','STOCK');

        $callback = function() use($stocks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,';');
            foreach ($stocks as $stock) {
                if($stock->stock_restant < 5){
                    $stockRestant = 0;
                }else if($stock->stock_restant < 20){
                    $stockRestant = rand(5,$stock->stock_restant-2);
                }else if($stock->stock_restant < 50){
                    $stockRestant = rand(20,$stock->stock_restant-2);
                }else if($stock->stock_restant < 100){
                    $stockRestant = rand(50,$stock->stock_restant-2);
                }else{
                    $stockRestant = rand(100,$stock->stock_restant-2);
                }
                $row = array();
                $row['GAMME']  = $stock->nom_gamme;
                $row['SKU']    = $stock->code_sku;
                $row['GENCODE']    = $stock->gencode;
                $row['DIMENSION']  = ($stock->largeur."x".$stock->longueur);
                $row['COULEUR']  = html_entity_decode($stock->nom_couleur);
                $row['STOCK']  = $stockRestant;
                fputcsv($file, array_map('utf8_decode',array($row['GAMME'], $row['SKU'], $row['GENCODE'], $row['DIMENSION'], $row['COULEUR'], $row['STOCK'])), ";");
            }
            

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
