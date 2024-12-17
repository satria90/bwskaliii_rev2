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
            'fullName' => 'sometimes|string|max:255',
            'password' => 'required|string|confirmed|min:8',
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg',
            'homeAddress' => 'sometimes|string|max:255',
            'phoneNumber' => 'required|string|max:15',
            'occupation' => 'sometimes|string|max:255',
            'companyName' => 'sometimes|string|max:255',
            'companyAddress' => 'sometimes|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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
            'fullName' => $request->fullName,
            'homeAddress' => $request->homeAddress,
            'phoneNumber' => $request->phoneNumber,
            'occupation' => $request->occupation,
            'avatar' => $avatarPath ?? null,
            'companyName' => $request->companyName,
            'companyAddress' => $request->companyAddress,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Akun berhasil dibuat');
    }
}
