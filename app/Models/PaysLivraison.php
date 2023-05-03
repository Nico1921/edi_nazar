<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaysLivraison extends Model
{
    use HasFactory;

    protected $table = 'pays_livraison';
    protected $primaryKey = 'id_pays_livraison'; 
    public $timestamps = false;

    protected $fillable = [
        'pays',
        'poids',
        'prix',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

   public static function getPaysLivraison($nomPays, $poidsMin) {
      return PaysLivraison::where('pays', '=', $nomPays)
              ->where('poids', '>=', $poidsMin)
              ->orderBy('poids', 'ASC')
              ->first();
  }

  public static function getPrixLivraison($pays, $poids) {
    $prixLivraison = 12.36;
        $exist = PaysLivraison::where('pays','=',$pays)->first();
        if(isset($exist->id_pays_livraison) && $exist->id_pays_livraison > 0){
            if($poids <= 30){
                $prixL = PaysLivraison::getPaysLivraison($pays,$poids);
                if(isset($prixL->id_pays_livraison) && $prixL->id_pays_livraison > 0){
                    $prixLivraison = $prixL->prix;
                }else{
                    $prixL = PaysLivraison::getPaysLivraison($pays,30);
                    $prixLivraison = $prixL->prix;
                }
            }else{
                $prixL = PaysLivraison::getPaysLivraison('France',30);
                $prixLivraison = $prixL->prix;
            }
        }else{
            if($poids <= 30){
                $prixL = PaysLivraison::getPaysLivraison('France',$poids);
                if(isset($prixL->id_pays_livraison) && $prixL->id_pays_livraison > 0){
                    $prixLivraison = $prixL->prix;
                }else{
                    $prixL = PaysLivraison::getPaysLivraison('France',$poids);
                    $prixLivraison = $prixL->prix;
                }
            }else{
                $prixL = PaysLivraison::getPaysLivraison('France',30);
                $prixLivraison = $prixL->prix;
            }
        }
    return $prixLivraison;
}
  
}
