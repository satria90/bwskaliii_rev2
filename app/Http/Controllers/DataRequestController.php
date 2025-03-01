<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataRequest;
use App\Http\Requests\UpdateDataRequest;
use App\Models\DataRequest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = DataRequest::orderByDesc('id');

        if ($user->hasRole('client')) {
            $query->where('user_id', $user->id);
        }

        $dataRequest = $query->paginate();

        return view('admin.data_requests.index', compact('dataRequest'));


    }

    public function create()
    {
        //
        $dataRequests = DataRequest::all();
        return view('admin.data_requests.create', compact('dataRequests'));
    }

    public function store(StoreDataRequest $request)
    {
        //
        $user = Auth::user();

        DB::transaction(function () use($request, $user) {
            // Validasi data
            $validated = $request->validated();

            // set default nilai status
            if (empty($request->Status)) {
                $validated['Status'] = 'diproses'; // Menetapkan nilai default
            }

            // if($request->hasFile('fileDataPerizinan')){
            //     $fileDataPerizinanPath = $request->file('fileDataPerizinan')->store('fileDataPerizinan','public');
            //     $validated['fileDataPerizinan'] = $fileDataPerizinanPath;
            // }

            // if($request->hasFile('fileDataRekomtek')){
            //     $fileDataRekomtekPath = $request->file('fileDataRekomtek')->store('fileDataRekomtek','public');
            //     $validated['fileDataRekomtek'] = $fileDataRekomtekPath;
            // }

            if($request->hasFile('fileDataSda')){
                $fileDataSdaPath = $request->file('fileDataSda')->store('fileDataSda','public');
                $validated['fileDataSda'] = $fileDataSdaPath;
            }

            // if($request->hasFile('fileDataPeminjaman')){
            //     $fileDataPeminjamanPath = $request->file('fileDataPeminjaman')->store('fileDataPeminjaman','public');
            //     $validated['fileDataPeminjaman'] = $fileDataPeminjamanPath;
            // }

            // if($request->hasFile('fileDataPengaduan')){
            //     $fileDataPengaduanPath = $request->file('fileDataPengaduan')->store('fileDataPengaduan','public');
            //     $validated['fileDataPengaduan'] = $fileDataPengaduanPath;
            // }

            // Tambahkan user_id ke data yang divalidasi
            $validated['user_id'] = $user->id;

            // Simpan data ke tabel data_requests
            DataRequest::create($validated);
        });

        return redirect()->route('admin.data_requests.index')->with('success', 'Data berhasil disimpan.');
    }

    public function show($id)
    {
        // Cari data request berdasarkan ID
        $dataRequest = DataRequest::findOrFail($id);

        // Periksa apakah data request milik pengguna yang sedang login
        // if ($dataRequest->user_id !== Auth::id()) {
        //     // Jika tidak sesuai, redirect atau tampilkan pesan error
        //     return redirect()->route('admin.data_requests.index')->with('error', 'Anda tidak memiliki izin untuk mengakses data ini.');
        // }

        // Jika ID cocok, tampilkan data
        return view('admin.data_requests.show', compact('dataRequest'));
    }


    public function edit(DataRequest $dataRequest)
    {
        //
        return view('admin.data_requests.edit', compact('dataRequest'));
    }

    public function update(UpdateDataRequest $request, DataRequest $dataRequest)
    {
        //
        $user = Auth::user();

        // Periksa role user terlebih dahulu
        if ($user->hasRole('client')) {
            // Jika client, langsung redirect sebelum melakukan update
            return redirect()->route('admin.data_requests.index');
        }

        // Melakukan transaksi untuk update dataRequest
        DB::transaction(function () use ($request, $dataRequest) {
            // Validasi data
            $validated = $request->validated();

            // Upload file identitas jika ada
            if ($request->hasFile('identityFile')) {
                $identityFilePath = $request->file('identityFile')->store('identityFile', 'public');
                $validated['identityFile'] = $identityFilePath;
            }

            // if($request->hasFile('fileDataPerizinan')){
            //     $fileDataPerizinanPath = $request->file('fileDataPerizinan')->store('fileDataPerizinan','public');
            //     $validated['fileDataPerizinan'] = $fileDataPerizinanPath;
            // }

            // if($request->hasFile('fileDataRekomtek')){
            //     $fileDataRekomtekPath = $request->file('fileDataRekomtek')->store('fileDataRekomtek','public');
            //     $validated['fileDataRekomtek'] = $fileDataRekomtekPath;
            // }

            if($request->hasFile('fileDataSda')){
                $fileDataSdaPath = $request->file('fileDataSda')->store('fileDataSda','public');
                $validated['fileDataSda'] = $fileDataSdaPath;
            }

            // if($request->hasFile('fileDataPeminjaman')){
            //     $fileDataPeminjamanPath = $request->file('fileDataPeminjaman')->store('fileDataPeminjaman','public');
            //     $validated['fileDataPeminjaman'] = $fileDataPeminjamanPath;
            // }

            // if($request->hasFile('fileDataPengaduan')){
            //     $fileDataPengaduanPath = $request->file('fileDataPengaduan')->store('fileDataPengaduan','public');
            //     $validated['fileDataPengaduan'] = $fileDataPengaduanPath;
            // }

            if ($request->hasFile('fileDataRequest')) {
                $fileDataRequestPath = $request->file('fileDataRequest')->store('fileDataRequest', 'public');
                $validated['fileDataRequest'] = $fileDataRequestPath;
            }

            if ($validated['Status'] === 'diterima' && $dataRequest->Status !== 'diterima') {
                $validated['is_Proof'] = false;
            }

            // Update dataRequest dengan data yang sudah divalidasi
            $dataRequest->update($validated);
        });

        // Setelah transaksi selesai, kembali ke index
        return redirect()->route('admin.data_requests.index');
    }



    public function destroy(DataRequest $dataRequest)
    {
        //
        DB::beginTransaction();

        try {
            $dataRequest->delete();
            DB::commit();
            
            return redirect()->route('admin.data_requests.index');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.data_requests.index')->with('error', 'terjadinya sebuah error');
        }

    }

    public function upload(DataRequest $dataRequest)
    {
        return view('admin.data_requests.upload', compact('dataRequest'));
    }

    public function handleUpload(UpdateDataRequest $request , DataRequest $dataRequest)
    {

       // Upload file
       if ($request->hasFile('fileDataRequest')) {
        $fileDataRequestPath = $request->file('fileDataRequest')->store('fileDataRequest', 'public');
        $dataRequest->update(['fileDataRequest' => $fileDataRequestPath]);
    }

        return redirect()->route('admin.data_requests.index')->with('success', 'File berhasil diupload.');
    }

    
}