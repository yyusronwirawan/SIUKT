<?php

namespace App\Exports;

use App\Models\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormatExcel implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Logika Anda untuk mengambil data yang akan diekspor ke Excel
        // Misalnya, mengambil data dari database
        return Excel::all();
    }

    public function headings(): array
    {
        // Atur judul kolom Excel
        return [
            'Kolom 1',
            'Kolom 2',
            'Kolom 3',
            // ...
        ];
    }
}
