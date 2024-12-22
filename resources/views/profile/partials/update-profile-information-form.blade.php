<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informasi Data Diri') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Lengkapi data diri anda agar dapat meengirimkan permohonan data") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 p-2 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        
        <div>
            <x-input-label class="mb-2" for="avatar" :value="__('Foto Profil')" />
            @if($user->avatar)
                <img src="{{ Storage::url($user->avatar) }}" alt="avatar" class="w-32 h-32 mb-2 rounded block object-cover align-middle">
            @endif
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 p-2 block w-full" :value="old('avatar', $user->avatar)" autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Surel')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 p-2 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="fullName" :value="__('Nama Lengkap')" />
            <x-text-input id="fullName" name="fullName" type="text" class="mt-1 p-2 block w-full" :value="old('fullName',$user->fullName)" required autofocus placeholder="Masukkan Nama Lengkap" />
            <x-input-error class="mt-2" :messages="$errors->get('fullName')" />
        </div>

        <div>
            <x-input-label for="phoneNumber" :value="__('Nomor Telepon')" />
            <x-text-input id="phoneNumber" name="phoneNumber" type="text" class="mt-1 p-2 block w-full" :value="old('phoneNumber',$user->phoneNumber)" required autofocus placeholder="Masukkan Nomor Telepon(WA)" />
            <x-input-error class="mt-2" :messages="$errors->get('phoneNumber')" />
        </div>
        
        <div>
            <x-input-label for="homeAddress" :value="__('Alamat Rumah')" />
            <x-text-input id="homeAddress" name="homeAddress" type="text" class="mt-1 p-2 block w-full" :value="old('homeAddress',$user->homeAddress)" required placeholder="Masukkan Alamat Rumah" />
            <x-input-error class="mt-2" :messages="$errors->get('homeAddress')" />
        </div>
        
        <div>
            <x-input-label for="occupation" :value="__('Pekerjaan')" />
            <x-text-input id="occupation" name="occupation" type="text" class="mt-1 p-2 block w-full" :value="old('occupation',$user->occupation)" required placeholder="Masukkan Pekerjaan" />
            <x-input-error class="mt-2" :messages="$errors->get('occupation')" />
        </div>
        
        <div>
            <x-input-label for="companyName" :value="__('Nama Perusahaan')" />
            <x-text-input id="companyName" name="companyName" type="text" class="mt-1 p-2 block w-full" :value="old('companyName',$user->companyName)" required placeholder="Masukkan Nama Perusahaan" />
            <x-input-error class="mt-2" :messages="$errors->get('companyName')" />
        </div>
        
        <div>
            <x-input-label for="companyAddress" :value="__('Alamat Perusahaan')" />
            <x-text-input id="companyAddress" name="companyAddress" type="text" class="mt-1 p-2 block w-full" :value="old('companyAddress',$user->companyAddress)" required placeholder="Masukkan Alamat Perusahaan" />
            <x-input-error class="mt-2" :messages="$errors->get('companyAddress')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
