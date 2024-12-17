<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <title>BWSKAL III</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="icon" href="{{ asset('assets\logo/logoPU.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white shadow-2xl h-full w-full flex flex-col md:flex-row">
            <!-- Left Side (Form) -->
            <div class="w-full md:w-1/2 p-8 md:p-20 flex flex-col justify-center">
                <div class="flex flex-col items-center mb-5">
                    <!-- Logo -->
                    <img src="{{ asset('assets\logo/logo lama.png') }}" alt="Logo PUPR" class="h-24 mb-3" />
                    <h2 class="text-5xl font-medium text-gray-700 mb-2">Selamat Datang</h2>
                    <p class="text-gray-500 text-lg">Pelayanan Balai Wilayah Sungai Kalimantan III</p>
                </div>

                <!-- Notification Alert for Errors -->
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded" role="alert">
                        <strong>Perhatian!</strong> {{ $errors->first() }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        <strong>Sukses!</strong> {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                     <!-- Display Success Message if available -->
                    @if(session('success'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('success') }}
                    </div>
                    @endif
                    {{-- nama --}}
                    <div class="mb-4 w-full">
                        <x-input-label for="name" :value="__('Nama')" class="block text-gray-900 text-lg mb-2"/>
                        <x-text-input id="name" type="name" name="name" :value="old('name')" required autofocus class="w-full px-3 py-2 border border-gray-300 rounded-lg text-lg focus:outline-none focus:ring-2 focus:ring-gray-400" placeholder="Masukan nama" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-4 w-full">
                        <x-input-label for="email" :value="__('Alamat Surel')" class="block text-gray-900 text-lg mb-2"/>
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus class="w-full px-3 py-2 border border-gray-300 rounded-lg text-lg focus:outline-none focus:ring-2 focus:ring-gray-400" placeholder="Masukan Alamat Surel" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Phone Number --}}
                    <div class="mb-4 w-full">
                        <x-input-label for="phoneNumber" :value="__('Nomor Telepon (WA)')" class="block text-gray-900 text-lg mb-2"/>
                        <x-text-input id="phoneNumber" type="text" name="phoneNumber" :value="old('phoneNumber')" required autofocus class="w-full px-3 py-2 border border-gray-300 rounded-lg text-lg focus:outline-none focus:ring-2 focus:ring-gray-400" placeholder="Masukan Nomor Telpon (WA)" />
                        <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4 w-full">
                        <x-input-label for="password" :value="__('Kata Sandi')" class="block text-gray-900 text-base mb-2"/>
                        <x-text-input id="password" type="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-lg focus:outline-none focus:ring-2 focus:ring-gray-400" placeholder="Masukan Password"/>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- konfirmasi kata sandi --}}
                    <div class="mb-6 w-full">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="block text-gray-900 text-sm mb-2"/>
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-lg focus:outline-none focus:ring-2 focus:ring-gray-400" placeholder="Masukan konfirmasi kata sandi"/>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit" class="w-full bg-black text-white font-semibold py-3 rounded-lg text-base hover:bg-gray-800 transition duration-500">
                        {{ __('Daftar') }}
                    </button>

                    <!-- Login -->
                    <p class="text-center text-lg mt-4">
                        Sudah ada akun,
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800 ">
                             {{ __('Masuk') }}
                        </a>
                    </p>
                </form>
            </div>

            <!-- Right Side (Swiper Slider for Image) -->
            <div class="w-full md:w-1/2 bg-black hidden md:block relative">
                <div class="swiper mySwiper h-full">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            {{-- {{ asset('assets\logo/logo lama.png') }} --}}
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
            autoplay: { delay: 3000 },
            speed: 1500,
        });
    </script>
</body>
</html>
