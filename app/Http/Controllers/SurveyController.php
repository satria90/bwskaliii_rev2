<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyRequest;
use App\Models\DataRequest;
use App\Models\Survey;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $dataRequestId = $request->query('dataRequestId');
        $dataRequest = DataRequest::findOrFail($dataRequestId);
        return view('admin.surveys.create', compact('dataRequest'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SurveyRequest $request, DataRequest $dataRequest)
    {
        
        DB::transaction(function () use ($request) {
            // Validasi data survei
            $validated = $request->validated();
    
            // Simpan survei ke database
            $survey = Survey::create($validated);
    
            // Dapatkan dataRequest berdasarkan ID yang diterima
            $dataRequest = DataRequest::findOrFail($request->dataRequestId);
    
            // Update dataRequest: Set is_proof menjadi true dan simpan ID survei
            $dataRequest->survey()->associate($survey); 
            $dataRequest->update([
                'is_Proof' => true,
                'survey_id' => $survey->id,
            ]);
        });

        return redirect()->route('admin.data_requests.index')->with('success', 'Survei Berhasil di Isi.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
