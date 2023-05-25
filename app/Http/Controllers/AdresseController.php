<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use App\Models\AdresseEdi;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AdresseController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $user = User::with(['client'])->find(Auth::user()->getAuthIdentifier())->first();
        $adresseEDI = AdresseEdi::with(['adresse'])->where('id_client','=',$user->client->id_client)->get();
        return Inertia::render('Auth/Pages/User/Adresses',[
            'adresses' => $adresseEDI
        ]);
    }

    public function save_adresse(Request $request){
        $user = User::with(['client'])->find(Auth::user()->getAuthIdentifier())->first();

        $request->validate([
            'nom_adresse' => [
                'required',
                'string',
                'max:255',
                Rule::unique('adresse_edi','nom_adresse')
                    ->where(fn (Builder $query) => 
                        $query->where('id_client', $user->client->id_client)
                        ->whereNot(function ($query) use($request){
                            $query->where('id_adresse_edi','=',$request->id_adresse_edi);
                        })
                    )
            ],
            'nom_contact' => 'required|string|max:255',
            'adresse1' => 'required|string|max:250',
            'adresse2' => 'nullable|string|max:250',
            'adresse3' => 'nullable|string|max:250',
            'pays' => 'required|country_name',
            'code_postal' => 'required|postal_code:pays',
            'ville' => 'required|string|max:50',
            'tel1' => 'required|numeric|phone:AUTO,FR',
            'id_adresse' => 'present|nullable'
        ]);
        if($request->id_adresse != 0 && !empty($request->id_adresse) && $request->id_adresse_edi != 0 && !empty($request->id_adresse_edi)){
            $adresse = Adresse::where('id_adresse','=',$request->id_adresse)->exists();
            $adresse_edi = AdresseEdi::where('id_adresse_edi','=',$request->id_adresse_edi)->exists();
            if($adresse && $adresse_edi){
                $adresse = Adresse::where('id_adresse','=',$request->id_adresse)->first();
                $adresse->nom_contact = $request->nom_contact;
                $adresse->adresse1 = $request->adresse1;
                $adresse->adresse2 = $request->adresse2;
                $adresse->adresse3 = $request->adresse3;
                $adresse->pays = $request->pays;
                $adresse->code_postal = $request->code_postal;
                $adresse->ville = $request->ville;
                $adresse->tel1 = $request->tel1;
                $adresse->save();

                $adresse_edi = AdresseEdi::where('id_adresse_edi','=',$request->id_adresse_edi)->first();
                $adresse_edi->nom_adresse = $request->nom_adresse;
                $adresse_edi->save();

                return redirect()->back()->with(['status' => true,'message' => 'Votre adresse a bien été modifiée !']);
            }else{
                return redirect()->back()->with(['status' => false,'message' => 'Une erreur s\'est produite lors de l\'enregistrement de votre adresse, veuillez ressayer !']);
            }
        }else{
            $adresse = Adresse::create([
                'date_ajout' => date('Y-m-d H:i:s'),
                'date_maj' => date('Y-m-d H:i:s'),
                'id_user' => 0,
                'id_user_maj' => 0,
                'id_client' => $user->client->id_client,
                'nom_contact' => $request->nom_contact,
                'adresse1' => $request->adresse1,
                'adresse2' => $request->adresse2,
                'adresse3' => $request->adresse3,
                'code_postal' => $request->code_postal,
                'ville' => $request->ville,
                'pays' => $request->pays,
                'tel1' => $request->tel1,
                'tel2' => '',
                'statut' => 1
            ]);

            if($adresse->id_adresse != 0 && !empty($adresse->id_adresse)){
                $adresseEdi = AdresseEdi::create([
                    'id_adresse' => $adresse->id_adresse,
                    'id_client' => $user->client->id_client,
                    'nom_adresse' => $request->nom_adresse,
                ]);
                return redirect()->back()->with(['status' => true,'message' => 'Votre adresse a bien été enregistrée !']);
            }else{
                return redirect()->back()->with(['status' => false,'message' => 'Une erreur s\'est produite lors de l\'enregistrement de votre adresse, veuillez ressayer !']);
            }
        }
    }

    public function delete_adresse(Request $request){
        if(isset($request->id_adresse_edi) && !empty($request->id_adresse_edi) && $request->id_adresse_edi > 0){
            $adresse_edi = AdresseEdi::where('id_adresse_edi','=',$request->id_adresse_edi)->exists();
            if($adresse_edi){
                $adresse_ediGet = AdresseEdi::where('id_adresse_edi','=',$request->id_adresse_edi)->first();
                $nom_adresse = $adresse_ediGet->nom_adresse;
                $adresse_edi = AdresseEdi::where('id_adresse_edi','=',$request->id_adresse_edi)->delete();
                if($adresse_edi){
                    return redirect()->back()->with(['status' => true, 'message' =>'L\'adresse '.$nom_adresse.' a bien été supprimée !']);
                }else{
                    return redirect()->back()->with(['status' => false, 'message', 'Une erreur s\'est produite lors de la suppression de l\'adresse.']);
                }
            }else{
                return redirect()->back()->with(['status' => false, 'message', 'Une erreur s\'est produite lors de la suppression de l\'adresse.']);
            }
        }else{
            return redirect()->back()->with(['status' => false, 'message', 'Une erreur s\'est produite lors de la suppression de l\'adresse. Veuillez réessayer ultérieurement.']);
        }
    }
}
