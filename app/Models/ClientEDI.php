<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClientEDI extends Model
{
    use HasFactory;

    protected $table = "client_edi";
    protected $primaryKey = "id_client_edi";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date_ajout',
        'date_maj',
        'nom',
        'prenom',
        'email',
        'tel',
        'date_commande',
        'ref_externe',
        'nom_adresse',
        'adresse1',
        'adresse2',
        'adresse3',
        'pays',
        'code_postal',
        'ville',
        'nom_adresse_facturation',
        'adresse1_facturation',
        'adresse2_facturation',
        'adresse3_facturation',
        'pays_facturation',
        'code_postal_facturation',
        'ville_facturation',
        'num_commande',
        'quantiter',
        'total_ht',
        'total_taxe',
        'total_ttc',
        'poids',
        'total_m2',
        'id_panier_edi',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id_panier_edi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_maj' => 'datetime',
    ];

    /**
     * Permet la récupération de la liste du panier lier au client
     */
    public function panier_list()
    {
        return $this->belongsTo(PanierEdiList::class,'id_client_edi','id_client_edi');
    }

    /**
     * Permet la récupération du panier lier au client
     */
    public function panier()
    {
        return $this->belongsTo(PanierEdi::class,'id_panier_edi','id_panier_edi');
    }

    public static function genNumCommande($id_panier){
        $panier = PanierEdi::where('id_panier_edi','=',$id_panier)->first();
        $countNbCommande = ClientEDI::where('id_panier_edi','=',$id_panier)->count('*');
        $countNbCommande++;
        return $panier->num_commande.'_'.$countNbCommande;
    }

    public static function calculPrixPanier($id_client){
        $total_ttc = 0.00;
        $quantiterTotal = 0;
        $m2TT = 0.00;
        $poidsTT = 0.00;

        $total_ttc = DB::table('panier_edi_list')->where('id_client_edi', '=', $id_client)->sum('prix_ttc_total');
        $quantiterTotal = DB::table('panier_edi_list')->where('id_client_edi', '=', $id_client)->sum('quantiter');

        $panierList = PanierEdiList::where('id_client_edi', '=', $id_client)->get();
        foreach ($panierList as $panierO) {
            $produit = Produit::with(['dimension', 'design'])->where('id_produit', '=', $panierO->id_produit)->first();
            //$gamme = Gamme::where('id_gamme', '=', $produit->design->id_gamme)->first();
            $gamme = Gamme::where('id_gamme', '=', $produit->gamme_id)->first(); 
            
            $m2 = ($produit->dimension->largeur / 100) * ($produit->dimension->longueur / 100);
            $m2TT = $m2TT + ($m2 * $panierO->quantiter);
            $poidsTT = $poidsTT + ($m2 * $panierO->quantiter) * $gamme->poids_m2_KG;
        }

        $total_ht = round($total_ttc / 1.2,2);
        $total_tva = $total_ttc - $total_ht;

        $clientsPanier = ClientEDI::where('id_client_edi', '=', $id_client)->first();
        $clientsPanier->total_ht = $total_ht;
        $clientsPanier->total_taxe = $total_tva;
        $clientsPanier->total_ttc = $total_ttc;
        $clientsPanier->total_m2 = $m2TT;
        $clientsPanier->poids = $poidsTT;
        $clientsPanier->quantiter = $quantiterTotal;
        $clientsPanier->save();

        // return true;
    }
}
