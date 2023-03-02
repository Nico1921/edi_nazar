<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Facture extends Model
{
    use HasFactory;

    protected $table = "facture";
    protected $primaryKey = "id_facture";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date_ajout',
        'date_maj',
        'id_commande',
        'date_proforma',
        'num_proforma',
        'date_facture',
        'num_facture',
        'montant_ttc',
        'taux_tva',
        'montant_ht',
        'total_ht',
        'montant_tva',
        'montant_due_ttc',
        'montant_port_ht',
        'date_echeance',
        'gen_facture',
        'observation',
        'interne',
        'exoneration',
        'date_livraison',
        'reference',
        'commission_ttc',
        'commission_ht',
        'commission_tva',
        'remboursement_ttc',
        'remboursement_ht',
        'remboursement_tva',
        'abonnement_ttc',
        'abonnement_ht',
        'abonnement_tva'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'date_ajout',
        'date_maj',
        'id_user',
        'id_user_maj',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    public static function genNumProforma(){
        $numProformaGet = Facture::where('num_proforma','LIKE',"DEV" . date('y') . date('m') . "%")->max('num_proforma');
        if(!empty($numProformaGet)){
            $numProforma = substr($numProformaGet,3);
            $num_proforma = (!empty($numProforma) ? 'DEV' . sprintf("%07s", ($numProforma + 1)) : 'DEV' . date('y') . date('m') . '001');
        }else{
            $num_proforma = 'DEV' . date('y') . date('m') . '001';
        }

        return $num_proforma;
    }

    public static function genNumFacture(){
        $numFactureGet = Facture::where('num_facture','LIKE',"F" . date('y') . "5%")->max('num_facture');
        if(!empty($numFactureGet)){
            $numFacture = substr($numFactureGet,1);
            $num_facture = (!empty($numFacture) ? 'F' . sprintf("%07s", ($numFacture + 1)) : 'F' . date('y') . '50000');
        }else{
            $num_facture = 'F' . date('y') . '50000';
        }

        return $num_facture;
    }
}
