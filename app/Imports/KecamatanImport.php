<?php

namespace App\Imports;

use App\Models\Province;
use App\Models\City;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class KecamatanImport implements ToCollection, WithStartRow, WithValidation, SkipsEmptyRows
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            Kecamatan::create([
                'kelurahan_id'  => $row[0],
                'name'          => $row[1]
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '0' => function($attribute, $value, $onFailure) {
                if(empty($value)){
                    $onFailure('Kelurahan Tidak Boleh Kosong');
                }
            },
            '1' => function($attribute, $value, $onFailure) {
                if(empty($value)){
                    $onFailure('Kecamatan Tidak Boleh Kosong');
                }
            }
        ];
    }
}
