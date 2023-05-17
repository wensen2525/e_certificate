<?php

namespace App\Imports;

use App\Models\BOM30th;
use Maatwebsite\Excel\Concerns\ToModel;

class BomImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BOM30th([
            'name' => $row['1'],
            'nim' => $row['2'],
        ]);
    }
}
