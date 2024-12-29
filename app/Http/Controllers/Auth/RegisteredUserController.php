<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'fullName' => 'sometimes|string|max:255',
            'password' => 'required|string|confirmed|min:8',
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg',
            // 'homeAddress' => 'sometimes|string|max:255',
            'phoneNumber' => 'required|string|max:15',
            // 'occupation' => 'sometimes|string|max:255',
            // 'companyName' => 'sometimes|string|max:255',
            // 'companyAddress' => 'sometimes|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // Pesan Error
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal harus :min karakter.',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Avatar hanya boleh berupa file jpeg, png, atau jpg.',
            'phoneNumber.required' => 'Nomor telepon wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
        ]);
        
        //  proses upload file photo kepada project larvel
        if($request->hasFile('avatar')){
            $avatarPath = $request->file('avatar')->store('avatar','public');
        }else{
            $avatarPath= 'assets/img/avatar-default.png';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'avatar' => $avatarPath ?? null,
            'companyAddress' => $request->companyAddress,
            'password' => Hash::make($request->password),
            // 'fullName' => $request->fullName,
            // 'homeAddress' => $request->homeAddress,
            // 'occupation' => $request->occupation,
            // 'companyName' => $request->companyName,
        ]);

         // Memberikan role "client" ke pengguna baru
        $user->assignRole('client');

        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Akun berhasil dibuat');
    }
}
