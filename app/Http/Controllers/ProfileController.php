<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\StoreApprovalRequest;
use App\Models\approval;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        $approval = approval::where('user_id', auth()->id())->first();

    return view('profile.edit', [
        'user' => $user,
    ], compact('approval'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        DB::transaction(function () use ($request, $user) {
            $validated = $request->validated();

            // Cek apakah ada file avatar yang di-upload
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatar', 'public');
                $validated['avatar'] = $avatarPath;
            }


            // Mengisi data user dengan data yang sudah divalidasi
            $user->fill($validated);

            // Jika email diubah, maka reset verifikasi email
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            // Simpan perubahan ke database
            $user->save();
        });

        // Redirect ke halaman profil dengan pesan sukses
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
