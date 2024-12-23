<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('dist\css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <title>BWSKAL III | Survey</title>
    <link rel="icon" href="{{ asset('assets/logo/logoPU.png') }}" type="image/png">
    @vite('resources/css/app.css')
</head>
<body class="text-gray-800 font-poppins bg-gray-100">
    
    <!-- Start Sidebar -->
    <div class="fixed left-0 top-0 w-64 h-full bg-white p-4 z-50 sidebar-menu transition-transform ">
        <a href="#home">
        <div class="flex items-center">
            <img src="{{ asset('assets\logo/logo.png') }}" alt="Logo-instansi">
        </div>
        </a>
        <ul class="mt-3">
            <li class="font-poppins mb-1 group">
                <a href="{{ route('dashboard') }}" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:text-gray-300 ">
                    <i class="ri-computer-line mr-3 text-lg"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li class="font-bold font-poppins mb-1">
                PELAYANAN
            </li>
            <li class="font-poppins mb-1 group active">
                <a href="#" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:bg-gray-300 group-[.active]:text-blue-900 ">
                    <i class="ri-foggy-line mr-1 text-lg"></i>
                    <span>Permohonan</span>
                </a>
            </li>@role('admin|owner')
            <li class="font-poppins mb-1 group">
                <a href="{{ route('admin.approvals.index') }}" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:text-gray-300 ">
                    <i class="ri-team-line mr-3 text-lg"></i>
                    <span>Manajemen Akun</span>
                </a>
            </li>
            @endrole
            @role('owner')
            <li class="font-poppins mb-1 group">
                <a href="{{ route('admin.admins.index') }}" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:text-gray-300 ">
                    <i class="ri-group-line mr-3 text-lg"></i>
                    <span>Manajemen Admin</span>
                </a>
            </li>
            @endrole
        </ul>
    </div>
     <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    <!-- End Sidebar -->

    <!-- Start Main -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-100 min-h-screen border-l border-gray-100 font-poppins transition-all main">
        <!-- Navbar Start -->
        <div class="py-2 px-6 bg-white flex items-center shadow-md shadow-gray-400 sticky top-0 left-0 z-30">
            <button type="button" class="text-2xl text-gray-600 sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>
            <ul class="flex items-center text-base ml-4 ">
                <li class="font-poppins mr-2">
                    <a href="#" class="text-xl ri-home-2-line hover:text-gray-500">Beranda</a>
                </li>
                <li class="mr-2">
                    <form method="POST" action="{{ route('logout') }}" style="display: none;" id="logout-form">
                        @csrf
                    </form>
                    <a href="logout" class="text-xl ri-logout-box-r-line font-poppins hover:text-gray-500"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Keluar
                    </a>
                </li>
            </ul>
            <ul class="ml-auto flex items-center">
                <li class="mr-2">
                    <button type="button">
                        <a href="{{ route('profile.edit') }}">
                            <img src="{{ 
                                Auth::user()->avatar 
                                ? (str_starts_with(Auth::user()->avatar, 'avatar/') 
                                    ? Storage::url(Auth::user()->avatar) 
                                    : asset(Auth::user()->avatar)) 
                                : asset('assets/img/avatar-default.png') }}"  class="w-11 h-11 rounded-full block object-cover align-middle">
                        </a>
                    </button>
                </li>
            </ul>
        </div>
        <!-- Navbar End -->

        <!-- Konten -->
        <div class="p-6">
            <h1 class="font-poppins font-bold text-xl">Form Survey Pelayanan</h1>
            <p class="font-poppins text-gray-400">Diharapkan  user mengisi survey dengan lengkap </p>
        </div>
        <div class="px-6 py-2">
            <div class="bg-white rounded-md border border-gray-100 shadow-black/5 p-6">
                <form method="POST" action="{{ route('admin.surveys.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="dataRequestId" value="{{ $dataRequest->id }}">
                    <!-- Pertanyaan 1 -->
                    <p class="font-poppins text-gray-900 font-bold text-lg">Sebelum mengunduh data, kami mohon kesediaan Anda untuk mengisi survei singkat guna membantu kami meningkatkan layanan.</p>
                    <label class="block mb-4">
                        <span class="block mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 text-sm font-poppins text-slate-700">
                            1. Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya?
                        </span>
                        <div class="space-y-2 ml-3">
                            <div class="flex items-center">
                                <input type="radio" id="question1-option1" name="question1" value="Tidak Sesuai" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question1-option1" class="ml-2 font-poppins text-sm text-slate-700">Tidak Sesuai</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question1-option2" name="question1" value="Cukup Sesuai" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question1-option2" class="ml-2 font-poppins text-sm text-slate-700">Cukup Sesuai</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question1-option3" name="question1" value="Sesuai" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question1-option3" class="ml-2 font-poppins text-sm text-slate-700">Sesuai</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question1-option4" name="question1" value="Sangat Sesuai" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question1-option4" class="ml-2 font-poppins text-sm text-slate-700">Sangat Sesuai</label>
                            </div>
                        </div>
                    </label>
                
                    <!-- Pertanyaan 2 -->
                    <label class="block mb-4">
                        <span class="block mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 text-sm font-poppins text-slate-700">
                            2. Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini?
                        </span>
                        <div class="space-y-2 ml-3">
                            <div class="flex items-center">
                                <input type="radio" id="question2-option1" name="question2" value="Tidak Mudah" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question2-option1" class="ml-2 font-poppins text-sm text-slate-700"> Sangat Tidak Mudah</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question2-option2" name="question2" value="Cukup Mudah" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question2-option2" class="ml-2 font-poppins text-sm text-slate-700"> Cukup Mudah</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question2-option3" name="question2" value="Mudah" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question2-option3" class="ml-2 font-poppins text-sm text-slate-700"> Mudah</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question2-option4" name="question2" value="Sangat Mudah" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question2-option4" class="ml-2 font-poppins text-sm text-slate-700">Sangat Mudah</label>
                            </div>
                        </div>
                    </label>
                
                    <!-- Pertanyaan 3 -->
                    <label class="block mb-4">
                        <span class="block mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 text-sm font-poppins text-slate-700">
                            3. Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan?
                        </span>
                        <div class="space-y-2 ml-3">
                            <div class="flex items-center">
                                <input type="radio" id="question3-option1" name="question3" value="Tidak Cukup Cepat" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question3-option1" class="ml-2 font-poppins text-sm text-slate-700"> Tidak Cukup Cepat</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question3-option2" name="question3" value="Cukup Cepat" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question3-option2" class="ml-2 font-poppins text-sm text-slate-700"> Cukup Cepat</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question3-option3" name="question3" value="Cepat" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question3-option3" class="ml-2 font-poppins text-sm text-slate-700"> Cepat</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question3-option4" name="question3" value="Sangat Cepat" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question3-option4" class="ml-2 font-poppins text-sm text-slate-700">Sangat Cepat</label>
                            </div>
                        </div>
                    </label>
                
                    <!-- Pertanyaan 4 -->
                    <label class="block mb-4">
                        <span class="block mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 text-sm font-poppins text-slate-700">
                            4. Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan?
                        </span>
                        <div class="space-y-2 ml-3">
                            <div class="flex items-center">
                                <input type="radio" id="question4-option1" name="question4" value="Sangat Mahal" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question4-option1" class="ml-2 font-poppins text-sm text-slate-700"> Sangat Mahal</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question4-option2" name="question4" value="Mahal" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question4-option2" class="ml-2 font-poppins text-sm text-slate-700"> Mahal</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question4-option3" name="question4" value="Murah" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question4-option3" class="ml-2 font-poppins text-sm text-slate-700"> Murah</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question4-option4" name="question4" value="Sangat Murah" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question4-option4" class="ml-2 font-poppins text-sm text-slate-700">Sangat Murah/Gratis</label>
                            </div>
                        </div>
                    </label>
                
                    <!-- Pertanyaan 5 -->
                    <label class="block mb-4">
                        <span class="block mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 text-sm font-poppins text-slate-700">
                            5. Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan?
                        </span>
                        <div class="space-y-2 ml-3">
                            <div class="flex items-center">
                                <input type="radio" id="question5-option1" name="question5" value="Tidak Sesuai" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question5-option1" class="ml-2 font-poppins text-sm text-slate-700"> Tidak Sesuai</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question5-option2" name="question5" value="Cukup Sesuai" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question5-option2" class="ml-2 font-poppins text-sm text-slate-700"> Cukup Sesuai</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question5-option3" name="question5" value="Sesuai" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question5-option3" class="ml-2 font-poppins text-sm text-slate-700"> Sesuai</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question5-option4" name="question5" value="Sangat Sesuai" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question5-option4" class="ml-2 font-poppins text-sm text-slate-700">Sangat Sesuai</label>
                            </div>
                        </div>
                    </label>
            
                    <!-- Pertanyaan 6 -->
                    <label class="block mb-4">
                        <span class="block mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 text-sm font-poppins text-slate-700">
                            6. Bagaimana pendapat Saudara tentang kompetensi/ kemampuan petugas dalam pelayanan?
                        </span>
                        <div class="space-y-2 ml-3">
                            <div class="flex items-center">
                                <input type="radio" id="question6-option1" name="question6" value="Tidak Kompeten" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question6-option1" class="ml-2 font-poppins text-sm text-slate-700"> Tidak Kompeten</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question6-option2" name="question6" value="Cukup Kompeten" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question6-option2" class="ml-2 font-poppins text-sm text-slate-700"> Cukup Kompeten</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question6-option3" name="question6" value="Kompeten" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question6-option3" class="ml-2 font-poppins text-sm text-slate-700"> Kompeten</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question6-option4" name="question6" value="Sangat Kompeten" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question6-option4" class="ml-2 font-poppins text-sm text-slate-700">Sangat Kompeten</label>
                            </div>
                        </div>
                    </label>
            
                    <!-- Pertanyaan 7 -->
                    <label class="block mb-4">
                        <span class="block mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 text-sm font-poppins text-slate-700">
                            7. Bagaimana pendapat Saudara perilaku petugas dalam pelayanan terkait kesopanan dan keramahan?
                        </span>
                        <div class="space-y-2 ml-3">
                            <div class="flex items-center">
                                <input type="radio" id="question7-option1" name="question7" value="Buruk" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question7-option1" class="ml-2 font-poppins text-sm text-slate-700"> Buruk</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question7-option2" name="question7" value="Cukup" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question7-option2" class="ml-2 font-poppins text-sm text-slate-700"> Cukup</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question7-option3" name="question7" value="Baik" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question7-option3" class="ml-2 font-poppins text-sm text-slate-700"> Baik</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question7-option4" name="question7" value="Sangat Baik" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question7-option4" class="ml-2 font-poppins text-sm text-slate-700">Sangat Baik</label>
                            </div>
                        </div>
                    </label>
            
                    <!-- Pertanyaan 8 -->
                    <label class="block mb-4">
                        <span class="block mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 text-sm font-poppins text-slate-700">
                            8. Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana?
                        </span>
                        <div class="space-y-2 ml-3">
                            <div class="flex items-center">
                                <input type="radio" id="question8-option1" name="question8" value="Buruk" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question8-option1" class="ml-2 font-poppins text-sm text-slate-700"> Buruk</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question8-option2" name="question8" value="Cukup" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question8-option2" class="ml-2 font-poppins text-sm text-slate-700"> Cukup</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question8-option3" name="question8" value="Baik" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question8-option3" class="ml-2 font-poppins text-sm text-slate-700"> Baik</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question8-option4" name="question8" value="Sangat Baik" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question8-option4" class="ml-2 font-poppins text-sm text-slate-700">Sangat Baik</label>
                            </div>
                        </div>
                    </label>
            
                    <!-- Pertanyaan 9 -->
                    <label class="block mb-4">
                        <span class="block mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 text-sm font-poppins text-slate-700">
                            9. Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan?
                        </span>
                        <div class="space-y-2 ml-3">
                            <div class="flex items-center">
                                <input type="radio" id="question9-option1" name="question9" value="Buruk" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question9-option1" class="ml-2 font-poppins text-sm text-slate-700"> Buruk</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question9-option2" name="question9" value="Cukup" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question9-option2" class="ml-2 font-poppins text-sm text-slate-700"> Cukup</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question9-option3" name="question9" value="Baik" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question9-option3" class="ml-2 font-poppins text-sm text-slate-700"> Baik</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question9-option4" name="question9" value="Sangat Baik" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question9-option4" class="ml-2 font-poppins text-sm text-slate-700">Sangat Baik</label>
                            </div>
                        </div>
                    </label>
            
                    <!-- Pertanyaan 10 -->
                    <label class="block mb-4">
                        <span class="block mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 text-sm font-poppins text-slate-700">
                            10. Secara keseluruhan, bagaimana pendapat Saudara tentang pelayanan yang diberikan?
                        </span>
                        <div class="space-y-2 ml-3">
                            <div class="flex items-center">
                                <input type="radio" id="question10-option1" name="question10" value="Buruk" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question10-option1" class="ml-2 font-poppins text-sm text-slate-700"> Buruk</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question10-option2" name="question10" value="Cukup" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question10-option2" class="ml-2 font-poppins text-sm text-slate-700"> Cukup</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question10-option3" name="question10" value="Baik" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question10-option3" class="ml-2 font-poppins text-sm text-slate-700"> Baik</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="question10-option4" name="question10" value="Sangat Baik" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="question10-option4" class="ml-2 font-poppins text-sm text-slate-700">Sangat Baik</label>
                            </div>
                        </div>
                    </label>

                    <label class="block mb-4">
                        <span class="block mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 text-sm font-poppins text-slate-700">
                            11. Apakah ada saran untuk pelayanan kami?
                        </span>
                        <input type="text" id="advice" required name="advice" class="mt-1 px-3 py-2 bg-gray-100 border shadow-sm border-slate-200 placeholder-gray-400 focus:outline-none focus:border-gray-300 focus:ring-gray-300 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan Saran" />
                    </label>

                    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Kirim
                    </button>
                </form>
            </div>
        </div>
        <!-- end konten -->
    </main>
    <!-- End Main -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>