<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NilaiSeleksiTemplateExport implements FromCollection, WithHeadings, WithMapping
{
    // Menyimpan data yang akan diekspor
    protected $data;

    // Konstruktor menerima data yang akan diekspor
    public function __construct($data)
    {
        $this->data = $data;
    }

    // Mengembalikan data yang akan diekspor dalam bentuk Collection
    public function collection()
    {
        return collect($this->data); // Mengubah array menjadi Collection
    }

    // Menentukan judul kolom pada sheet Excel
    public function headings(): array
    {
        return [
            'Siswa ID',        // Kolom pertama
            'Nama',            // Kolom kedua
            'Huruf Jepang',    // Kolom ketiga
            'Fisik',           // Kolom keempat
            'Matematika',      // Kolom kelima
            'Koran',           // Kolom keenam
        ];
    }

    // Memetakan setiap baris data menjadi array sesuai kolom yang sudah ditentukan
    public function map($row): array
    {
        return [
            $row['siswa_id'],         // Siswa ID
            $row['nama'],             // Nama siswa
            $row['huruf_jepang'],     // Nilai Huruf Jepang
            $row['fisik'],            // Nilai Fisik
            $row['matematika'],       // Nilai Matematika
            $row['koran'],            // Nilai Koran
        ];
    }
}
