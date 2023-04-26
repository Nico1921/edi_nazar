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
        $invoiceInitial = '22';
        $numInvoiceDefault = '2200001';
        $numInvoiceNext = '';
        $numInvoiceLast = '';
        $num_facture_max1 = DB::table('facture')->select(DB::raw('MAX(SUBSTRING(num_facture, 2)) as num_facture_max'))->where('num_facture', 'like', 'F' . $invoiceInitial . '%')->value('num_facture_max');
        $num_facture_max2 = DB::table('commande_marketplace')->select(DB::raw('MAX(SUBSTRING(num_facture, 2)) as num_facture_max'))->where('num_facture', 'like', 'F' . $invoiceInitial . '%')->value('num_facture_max');
        if (is_numeric($num_facture_max1) && is_numeric($num_facture_max2)) {
            $numInvoiceLast = max($num_facture_max1, $num_facture_max2);
        } elseif (is_numeric($num_facture_max1)) {
            $numInvoiceLast = $num_facture_max1;
        } elseif (is_numeric($num_facture_max2)) {
            $numInvoiceLast = $num_facture_max2;
        }
        $numInvoiceNext = (!empty($numInvoiceLast) ? sprintf("%07s", ($numInvoiceLast + 1)) : $numInvoiceDefault);
        return 'F' . $numInvoiceNext;
        }
}
