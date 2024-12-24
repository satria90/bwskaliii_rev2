<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\StoreApprovalRequest;
use App\Models\Approval;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        $approval = Approval::where('user_id', auth()->id())->first();

        return view('profile.edit', [
            'user' => $user,
            'approval' => $approval,
        ]);
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
                // Hapus avatar lama jika ada
                if ($user->avatar && Storage::exists($user->avatar)) {
                    Storage::delete($user->avatar);
                }

                // Simpan avatar baru
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
        return Redirect::route('profile.edit')->with('profileSuccess', 'data berhasil disimpan');
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

        // Hapus avatar pengguna jika ada
        if ($user->avatar && Storage::exists($user->avatar)) {
            Storage::delete($user->avatar);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
