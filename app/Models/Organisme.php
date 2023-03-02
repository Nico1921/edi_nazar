<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisme extends Model
{
    use HasFactory;

    protected $table = "organisme";
    protected $primaryKey = "id_organisme";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date_ajout',
        'date_maj',
        'id_user',
        'id_user_maj',
        'name_organisme',
        'email',
        'address1',
        'address2',
        'address3',
        'zipcode',
        'city',
        'country',
        'tel',
        'fax',
        'website',
        'capital',
        'RCI',
        'SIRET',
        'APE',
        'formation',
        'VAT',
        'owner_bank',
        'domiciliation_bank',
        'name_bank',
        'address_bank',
        'cp_bank',
        'city_bank',
        'country_bank',
        'bank_code',
        'branch_code',
        'account_bank',
        'key_digits',
        'swift_bic',
        'iban',
        'statut'
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
}
