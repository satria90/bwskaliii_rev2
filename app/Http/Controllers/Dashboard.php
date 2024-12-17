<?php

namespace App\Http\Controllers;

use App\Models\approval;
use App\Models\DataRequest;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    //
    public function index(){

        $user = Auth::user();
        // Membuat query dasar
        $dataRequestsQuery = DataRequest::query();

        // Filter berdasarkan role
        if ($user->hasRole('client')) {
            $dataRequestsQuery->where('user_id', $user->id);
        }

        // Ambil data approval berdasarkan user yang sedang login
        $approval = approval::where('user_id', auth()->id())->first();


        // Menghitung total data request yang masuk
        $totalRequests = $dataRequestsQuery->count();
        
        $dataRequestsCount = $dataRequestsQuery
            ->selectRaw('Status, count(*) as count')
            ->groupBy('Status')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->Status => $item->count];
            });

        $diproses = $dataRequestsCount['diproses'] ?? 0;
        $ditolak = $dataRequestsCount['ditolak'] ?? 0;
        $diterima = $dataRequestsCount['diterima'] ?? 0;
        
        // Mengambil semua data request (jika diperlukan di view)
        $dataRequests = $dataRequestsQuery->get();
        
        //coba menampilkan data suvey dalam bar
        // Soal untuk setiap pertanyaan
        $questionsText = [
            1 => "1. Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya?",
            2 => "2. Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini?",
            3 => "3. Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?",
            4 => "4. Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan?",
            5 => "5. Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan?",
            6 => "6. Bagaimana pendapat Saudara tentang kompetensi/ kemampuan petugas dalam pelayanan?",
            7 => "7. Bagaimana pendapat Saudara perilaku petugas dalam pelayanan terkait kesopanan dan keramahan?",
            8 => "8. Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana?",
            9 => "9. Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan?",
            10 => "10. Secara keseluruhan, bagaimana pendapat Saudara tentang pelayanan yang diberikan?"
        ];

        $questionsData = [];
        for ($i = 1; $i <= 10; $i++) {
            // Ambil data untuk setiap pertanyaan
            $questionData = Survey::select('question' . $i, DB::raw('count(*) as total'))
                                ->groupBy('question' . $i)
                                ->get();

            // Ambil soal untuk setiap pertanyaan
            $questionText = $questionsText[$i] ?? "Pertanyaan tidak ditemukan";  // Ganti soal jika diperlukan

            // Simpan label, data, dan soal untuk setiap pertanyaan
            $questionsData['question' . $i] = [
                'text' => $questionText,  // Soal pertanyaan
                'labels' => $questionData->pluck('question' . $i),
                'data' => $questionData->pluck('total')
            ];
        }

        // Mengirim data ke view
        return view('dashboard', compact('totalRequests','approval', 'diterima', 'diproses', 'ditolak', 'dataRequests',  'questionsData'));

    }
}
