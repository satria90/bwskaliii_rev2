<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <title>BWSKAL III | Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="icon" href="{{ asset('assets\logo/logoPU.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white shadow-2xl h-full w-full flex flex-col md:flex-row">
            <!-- Left Side (Form) -->
            <div class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center">
                <div class="flex flex-col items-center mb-5">
                    <!-- Logo -->
                    <img src="{{ asset('assets\logo/logo lama.png') }}" alt="Logo PUPR" class="h-24 mb-3" />
                    <h2 class="text-3xl font-medium text-gray-700 ">Atur Ulang Kata Sandi</h2>
                    <p class="text-gray-500 text-lg"></p>
                </div>

                <!-- Notification Alert for Errors -->
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded" role="alert">
                        <strong>Perhatian!</strong> {{ $errors->first() }}
                    </div>
                @endif

                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        <strong>Sukses!</strong> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
            
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
            
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Alamat Surel')" />
                        <x-text-input id="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-gray-400" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
            
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Kata Sandi')" />
                        <x-text-input id="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-gray-400" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
            
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata sandi')" />
            
                        <x-text-input id="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-gray-400"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />
            
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
            
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Atur Ulang kata Sandi') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Right Side (Swiper Slider for Image) -->
            <div class="w-full md:w-1/2 bg-black hidden md:block relative">
                <div class="swiper mySwiper h-full">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('assets/img/depan.jpeg') }}" alt="Mountain Image" class="w-full h-full object-cover" />
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('assets\img/plang.jpeg') }}" alt="Forest Image" class="w-full h-full object-cover" />
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('assets\img/BatikPU.jpeg') }}" alt="Beach Image" class="w-full h-full object-cover" />
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Navigation -->
                    <div class="swiper-button-next text-gray-500 hover:text-gray-600"></div>
                    <div class="swiper-button-prev text-gray-500 hover:text-gray-600"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            speed: 1500,
        });
    </script>
</body>
</html>

