<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informasi Data Diri') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Lengkapi data diri anda agar dapat mengirimkan permohonan data") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    @if (session('profileSuccess'))
    <div class="bg-green-100 border border-green-400 text-green-700 mt-2 px-4 py-3 rounded relative mb-2">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('profileSuccess') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Tutup</title><path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.914l-2.934 2.935a1 1 0 01-1.414-1.414l2.935-2.934-2.935-2.935a1 1 0 011.414-1.414L10 8.586l2.934-2.935a1 1 0 011.414 1.414l-2.935 2.935 2.935 2.934a1 1 0 010 1.414z"/></svg>
        </span>
    </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Tutup</title><path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.914l-2.934 2.935a1 1 0 01-1.414-1.414l2.935-2.934-2.935-2.935a1 1 0 011.414-1.414L10 8.586l2.934-2.935a1 1 0 011.414 1.414l-2.935 2.935 2.935 2.934a1 1 0 010 1.414z"/></svg>
            </span>
        </div>
    @endif

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 p-2 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="phoneNumber" :value="__('Nomor Telepon')" />
            <x-text-input id="phoneNumber" name="phoneNumber" type="text" class="mt-1 p-2 block w-full" :value="old('phoneNumber',$user->phoneNumber)" required autofocus placeholder="Masukkan Nomor Telepon(WA)" />
            <x-input-error class="mt-2" :messages="$errors->get('phoneNumber')" />
        </div>

        <div>
            <x-input-label class="mb-2" for="avatar" :value="__('Foto Profil')" />
            @if($user->avatar)
            <img src="{{ $user->avatar ? (str_starts_with($user->avatar, 'avatar/') ? Storage::url($user->avatar) : asset($user->avatar)) : asset('assets/img/avatar-default.png') }}" alt="avatar" class="w-32 h-32 mb-2 rounded block object-cover align-middle">        
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
