<?php

namespace App\Exports;

use App\Models\BOM30th;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BomExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BOM30th::all();
    }

    public function headings(): array {
        return [
            'NO',
            'NAME',
            'NIM',
            'PASSWORD',
            'HASHPASSWORD',
            'CREATED_AT',
            'UPDATED_AT'
        ];
    }
}
