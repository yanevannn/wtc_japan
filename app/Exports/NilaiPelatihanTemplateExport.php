<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NilaiPelatihanTemplateExport implements FromCollection, WithHeadings, WithMapping
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
            'Siswa ID',         // Kolom pertama
            'Nama',             // Kolom kedua
            'NIS',              // Kolom ketiga
            'hiragana',         // Kolom keempat
            'katakana',         // kolom kelima
            'kanji',            // Kolom keenam
            'bunpou',           // Kolom ketujuh
            'choukai',          // Kolom kedelapan
            'kaiwa',            // Kolom kesembilan
            'dokkai',           // Kolom kesepuluh
        ];
    }

    // Memetakan setiap baris data menjadi array sesuai kolom yang sudah ditentukan
    public function map($row): array
    {
        return [
            $row['siswa_id'],     // Siswa ID
            $row['nama'],         // Nama
            $row['nis'],          // NIS
            $row['hiragana'],     // hiragana
            $row['katakana'],     // katakana
            $row['kanji'],        // kanji
            $row['bunpou'],       // bunpou
            $row['choukai'],      // choukai
            $row['kaiwa'],        // kaiwa
            $row['dokkai'],       // dokkai
        ];
    }
}
