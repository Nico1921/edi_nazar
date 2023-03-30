<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class CommandeMarketplaceImport implements ToCollection,WithHeadingRow,WithValidation,SkipsEmptyRows
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    { 
        return $collection;
    }

    public function rules(): array 
    {
        return [
            'num_order' => 'required',
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'phone' => 'required|numeric|phone:AUTO,FR',
            'mail' => 'required|string|email|max:255',
            'nameaddr' => 'required|string|max:255',
            'addr1' => 'required|string|max:32',
            'addr2' => 'nullable|string|max:32',
            'addr3' => 'nullable|string|max:32',
            'country' => 'required|string|country_name',
            'zipcode' => 'required|string',
            'city' => 'required|string|string|max:32',
            'addrbill1' => 'required|string|max:32',
            'addrbill2' => 'nullable|string|max:32',
            'addrbill3' => 'nullable|string|max:32',
            'country_bill' => 'required|string|country_name',
            'zipcode_bill' => 'required|string',
            'city_bill' => 'required|string|max:32',
            'phone_bill' => 'required|numeric|phone:AUTO,FR',
            'mail_bill' => 'required|string|email|max:255',
            'ean_product' => 'required|numeric',
            'qte' => 'required|numeric|max:255'
        ];
    }
}
