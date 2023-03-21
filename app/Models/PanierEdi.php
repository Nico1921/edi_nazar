<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\FlareClient\Http\Client;

class PanierEdi extends Model
{
    use HasFactory;

    protected $table = "panier_edi";
    protected $primaryKey = "id_panier_edi";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date_ajout',
        'date_maj',
        'num_commande',
        'nb_client',
        'date_commande',
        'total_HT',
        'total_taxe',
        'total_ttc',
        'total_payer',
        'poids_total',
        'produits_total',
        'total_m2',
        'date_livraison',
        'is_validate',
        'payment_type',
        'is_marketplace',
        'id_etape',
        'id_users',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id_users',
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
     * Permet la récupération du users lier au panier
     */
    public function Users()
    {
        return $this->hasOne(User::class,'id_users','id');
    }

    /**
     * Permet la récupération de la liste des clients lier au panier
     */
    public function client_edi_list()
    {
        return $this->hasMany(ClientEDI::class,'id_panier_edi','id_panier_edi');
    }

    public static function calculPrixPanier($id_panier){
        $clientsPanier = ClientEDI::where('id_panier_edi','=',$id_panier)->get();
        
        $total_ttc = 0.00;
        $quantiterTotal = 0;
        $m2TT = 0.00; 
        $poidsTT = 0.00;
        foreach($clientsPanier as $client){ 
            $panier = DB::table('panier_edi_list')->where('id_client_edi','=',$client->id_client_edi)->sum('prix_ttc_total');
            $quantiter = DB::table('panier_edi_list')->where('id_client_edi','=',$client->id_client_edi)->sum('quantiter');
            Log::debug($quantiter);
            $total_ttc += $panier;
            $quantiterTotal += $quantiter;
               
            $panierList = PanierEdiList::where('id_client_edi','=',$client->id_client_edi)->get();
            foreach($panierList as $panierO){
                $produit = Produit::with(['dimension','design'])->where('id_produit','=',$panierO->id_produit)->first();
                $gamme = Gamme::where('id_gamme','=',$produit->design->id_gamme)->first();
                $m2 = ($produit->dimension->largeur/100) * ($produit->dimension->longueur/100);
                $m2TT = $m2TT + ($m2 * $panierO->quantiter); 
                $poidsTT = $poidsTT + ($m2 * $panierO->quantiter) * $gamme->poids_m2_KG;
                 
            }
            
        }

        $total_ht = round($total_ttc / 1.2,2);
        $total_tva = $total_ttc - $total_ht;
        
        $m2TT = round($m2TT,2);

        $panierFinal = PanierEdi::find($id_panier);
        $panierFinal->total_HT = $total_ht;
        $panierFinal->total_taxe = $total_tva;
        $panierFinal->total_ttc = $total_ttc;
        $panierFinal->total_m2 = $m2TT;
        $panierFinal->poids_total = $poidsTT;
        $panierFinal->produits_total = $quantiterTotal;    
        $panierFinal->save();

        // return true;
    }

    public static function generateNumOrder(){
        $search = PanierEdi::where('num_commande','like','%edi-'.date('ym').'1%')->max('num_commande');
        $num_commande = 'edi-'.date('ym').'10001';
        if(!empty($search)){
            $add = str_replace('edi-','',$search);
            if(is_numeric($add)){
                $add = $add+1;
                $num_commande = 'edi-'.$add;
            }
        }

        return $num_commande;
    }
}
