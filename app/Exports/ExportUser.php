<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Survey;

class ExportUser implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Survey::select('*')->get();
    }

    /**
     * Memetakan data ke dalam baris Excel
     *
     * @param mixed $survey
     * @return array
     */
    public function map($survey): array
    {
        return [
            $survey->id,
            $survey->question1,
            $survey->question2,
            $survey->question3,
            $survey->question4,
            $survey->question5,
            $survey->question6,
            $survey->question7,
            $survey->question8,
            $survey->question9,
            $survey->question10,
            $survey->advice,
        ];
    }

    /**
     * Menentukan kolom header yang akan ditampilkan di Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'id',
            'Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya?',
            'Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini?',
            'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?',
            'Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan?',
            'Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan?',
            'Bagaimana pendapat Saudara tentang kompetensi/ kemampuan petugas dalam pelayanan?',
            'Bagaimana pendapat Saudara perilaku petugas dalam pelayanan terkait kesopanan dan keramahan?',
            'Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana?',
            'Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan?',
            'Secara keseluruhan, bagaimana pendapat Saudara tentang pelayanan yang diberikan?',
            'Saran',
        ];
    }
}
