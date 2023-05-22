<?php

namespace App\Http\Controllers;

use App\Models\StatsProduit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function exportStockCsv(Request $request){
        if(isset($request->token) && !empty($request->token)){
            $user = User::with(['client'])->where('token_client','=',$request->token)->first();
            if(isset($user->id) && $user->id > 0){
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
            }else{
                return abort(404);
            }
        }else{
            return abort(400);
        }  
    }
}
