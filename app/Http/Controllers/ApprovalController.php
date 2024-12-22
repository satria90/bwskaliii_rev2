<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApprovalRequest;
use App\Models\approval;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $approvals = Approval::with('user')->get();

        return view('admin.approvals.index', compact('approvals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApprovalRequest $request)
{
    $user = Auth::user();
    
    DB::transaction(function () use($request, $user) {
        $validated = $request->validated();

        // Cek apakah file proof diunggah
        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('proof', 'public');
            $validated['proof'] = $proofPath;
        }

        $validated['user_id'] = $user->id;
        $validated['upload'] = false;

        // Cari data berdasarkan user_id
        $approval = Approval::where('user_id', $user->id)->first();

        if ($approval) {
            // Jika data sudah ada, ubah status aktif menjadi tidak aktif sebelum memperbarui
            if ($approval->status == 'aktif') {
                $approval->update(['status' => 'tidak aktif']);
            }

            // Update data yang sudah ada
            $approval->update($validated);
        } else {
            // Tambah data baru jika belum ada
            Approval::create($validated);
        }
    });

    return redirect()->route('profile.edit')->with('success', 'Status approval berhasil diperbarui.');
}

    

    /**
     * Display the specified resource.
     */
    public function show(approval $approval)
    {
        //
        return view('admin.approvals.show', compact('approval'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(approval $approval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, approval $approval)
    {
        //
        DB::transaction(function () use ($approval){
            $approval->update([
                'upload'=>true,
                'approval_start_date'=> Carbon::now()
            ]);
        });

        return redirect()->route("admin.approvals.show",$approval);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(approval $approval)
    {
        //
    }
    public function verify($id)
    {
        $approval = Approval::findOrFail($id);
        $approval->update(['upload' => true]);

        return redirect()->route('approvals.index')->with('status', 'Data terverifikasi.');
    }

}
