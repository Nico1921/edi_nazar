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
}
