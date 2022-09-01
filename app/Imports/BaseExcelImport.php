<?php

namespace App\Imports;

use App\Models\BaseExcel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class BaseExcelImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation, SkipsEmptyRows
{
    use RemembersRowNumber;

    public $row_number = 0;

    public function model(array $row)
    {
        return new BaseExcel([
            'user_id'       => auth()->user()->id,
            'date_import'   => now()->format('Y-m-d'),
            'row'           => $this->getRowNumber(),
        ]);
    }

    public function rules(): array
    {
        return [];
        //
        return [
            'email' => Rule::in(['patrick@maatwebsite.nl']),
        ];
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
