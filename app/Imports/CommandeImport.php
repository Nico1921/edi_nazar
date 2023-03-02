<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CommandeImport implements ToCollection,WithHeadingRow,WithValidation
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
            'ean_product' => 'required|numeric',
            'qte' => 'required|numeric|max:255'
        ];
    }
}
