<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informasi Data ID') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Lengkapi data ID anda agar dapat meengirimkan permohonana data") }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.approval.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="idNumber" :value="__('Nomor Identitas (NIK/KTP/Paspor)')" />
            <x-text-input id="idNumber" name="idNumber" type="text" class="mt-1 p-2 block w-full" :value="old('idNumber',$approval->idNumber ?? '')" required placeholder="Masukkan Nomor Identitas (NIK/KTP/Paspor)" />
            <x-input-error class="mt-2" :messages="$errors->get('idNumber')" />
        </div>
        
        <div>
            <x-input-label class="mb-2" for="proof" :value="__('Upload Identitas')" />
            @if($approval->proof ?? '')
                <img src="{{ Storage::url($approval->proof) }}" alt="proof" class="w-32 h-32 mb-2 rounded block object-cover align-middle">
            @endif
            <x-text-input id="proof" name="proof" type="file" class="mt-1 p-2 block w-full" required placeholder="Upload file Identitas" />
            <x-input-error class="mt-2" :messages="$errors->get('proof')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'File dikirim')
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
