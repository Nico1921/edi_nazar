<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPaiement extends Model
{
    use HasFactory;
    protected $table = "transaction_paiement";
    protected $primaryKey = "id_transaction_paiement ";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transaction_id',
        'date_transaction',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'transaction_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    public static function generate_id_transaction(){
        $unique = false;
        $id_transaction = 0;
        while(!$unique){
           $id_transaction = TransactionPaiement::unique_id(6);
           $checkId = TransactionPaiement::where('transaction_id','=',$id_transaction)->first();
           if(!isset($checkId->id_transaction_paiement) || empty($checkId->id_transaction_paiement)){
              $unique = true;
              TransactionPaiement::create([
                'transaction_id' => $id_transaction,
                'date_transaction' => date('Y-m-d H:i:s')
              ]);
           }
        }
     
        return $id_transaction;
    }

    public static function unique_id($l = 8) {
        return substr('edi'.md5(uniqid(mt_rand(), true)), 0, $l);
    }

    public static function verifySystempaySignature(array $parameters, string $signature)
    {
        // Retrieve the secret key from the configuration file
        $secretKey = config('systempay.key');

        // Sort the parameters by name
        ksort($parameters);

        $message = implode('+', $parameters) . '+' . $secretKey;

        $computedSignature = base64_encode(hash_hmac('sha256', $message, $secretKey, true));

        return $computedSignature === $signature;
    }


}
