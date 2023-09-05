<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TestImport implements ToArray, WithHeadingRow, WithValidation, WithChunkReading
{

    public function array(array $array)
    {
        return [];
    }


    public function rules(): array
    {
        return [
            ''
        ];
    }

    public function chunkSize(): int
    {
        return 10;
    }
}
