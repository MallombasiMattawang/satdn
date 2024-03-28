<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class SatsdnPemegangIzin implements FromCollection, WithHeadings, ShouldAutoSize
{
    use Exportable;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        // Anda dapat menyesuaikan judul kolom sesuai kebutuhan
        return [
            'Nama',
            'Usia',
            // ... tambahkan judul kolom lainnya sesuai kebutuhan
        ];
    }
}

