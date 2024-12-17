<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $admins = Admin::orderByDesc('id')->get();
        return view('admin.admins.index',[
            'admins' => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.admins.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        //
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();

        if(!$user){
            return back()->withErrors([
                'email' => 'Data tidak ditemukan'
            ]);
        }

        if($user->hasRole('admin')){
            return back()->withErrors([
                'email' => 'Email tersebut telah menjadi admin'
            ]);
        }

        DB::transaction(function () use ($user, $validated) {

            $validated['user_id'] = $user->id;
            $validated['is_active'] = true;

            Admin::create($validated);

            if ($user->hasRole('client')){
                $user->removeRole('client');
            }

            $user->assignRole('admin');
  
        });

        return redirect()->route('admin.admins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
        try {
            $admin->delete();
    
            $user = \App\Models\User::find($admin->user_id);
            $user->removeRole('admin');
            $user->assignRole('client');
    
            // Redirect ke halaman sebelumnya
            return redirect()->back();
        }
        
        catch (\Exception $e) {
            DB::rollBack();
            $error =ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()],
            ]);

            throw $error;
        }
    }
}
