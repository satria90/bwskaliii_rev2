<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('dist\css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <title>Dashboard</title>
    <link rel="icon" href="{{ asset('assets/logo/logoPU.png') }}" type="image/png">
    @vite('resources/css/app.css')
</head>
<body class="text-gray-800 font-poppins bg-gray-100">
    
    <!-- Start Sidebar -->
    <div class="fixed left-0 top-0 w-64 h-full bg-white p-4 z-50 sidebar-menu transition-transform ">
        <a href="{{ route('dashboard') }}">
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
            </li>
            @role('admin|owner')
            <li class="font-poppins mb-1 group">
                <a href="{{ route('register') }}" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:text-gray-300 ">
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
                <li class="mr-1">
                    <form action="" class="p-4">
                        <div class="relative w-full">
                            <input type="text" for="cari" placeholder="Search..." class="py-2 pr-4 pl-10 bg-gray-50 w-full outline-none border border-gray-100 rounded-md text-sm focus:border-blue-700" />
                            <i for="cari" class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                        </div>
                    </form>
                </li>
                <li class="dropdown mr-2">
                    <button type="button" class="dropdown-toggle text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600">
                        <i class="ri-notification-3-line"></i>
                    </button>
                    <div class="dropdown-menu shadow-md shadow-black/5 z-30 hidden max-w-xs w-full bg-white rounded-md border border-gray-100">
                        <div class="flex items-center px-4 pt-4 border-b border-b-gray-100 notification-tab">
                            <button type="button" data-tab="notification" data-tab-page="notifications" class="text-gray-400 font-medium text-[13px] hover:text-gray-600 border-b-2 border-b-transparent mr-4 pb-1 active">Notifications</button>
                        </div>

                        <div class="my-2">
                            <ul class="max-h-64 overflow-y-auto" data-tab-for="notification" data-page="notifications">
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">New order</div>
                                            <div class="text-[11px] text-gray-400">from a user</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
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
            </ul>
        </div>
        <!-- Navbar End -->

        <!-- Konten -->
        <div class="p-6">
            <h1 class="font-poppins font-bold text-xl">Form Permohonan Data</h1>
            <p class="font-poppins text-gray-400">Diharapkan  user mengisi data dengan lengkap</p>
        </div>
        <div class="px-6 py-2">
            <div class="bg-white rounded-md border border-gray-100 shadow-black/5 p-6">
                <form method="POST" action="{{ route('admin.data_requests.store') }}" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <h1 class="text-xl font-bold mb-6">
                            Pengajuan Permohonan Informasi
                        </h1>
                        <label class="block mb-3">
                            <span class="mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-poppins text-slate-700">
                              Jenis Informasi yang Dibutuhkan
                            </span>
                        </label>
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center">
                              <input type="checkbox" id="Rainfall" name="Rainfall" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                              <label for="ch" class="ml-2 font-poppins text-sm text-slate-700">Curah Hujan</label>
                            </div>
                          
                            <div class="flex items-center">
                              <input type="checkbox" id="RiverProfile" name="RiverProfile" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                              <label for="RiverProfile" class="ml-2 font-poppins text-sm text-slate-700">Profil Sungai</label>
                            </div>
                          
                            <div class="flex items-center">
                              <input type="checkbox" id="Topography" name="Topography" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                              <label for="Topography" class="ml-2 font-poppins text-sm text-slate-700">Topografi</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="StudyResearch" name="StudyResearch" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="StudyResearch" class="ml-2 font-poppins text-sm text-slate-700">Studi/Kajian</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="WaterAllocation" name="WaterAllocation" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="WaterAllocation" class="ml-2 font-poppins text-sm text-slate-700">Alokasi Air</label>
                            </div>

                            <input type="text" required id="otherCheckbox" name="otherCheckbox" class="mt-1 px-3 py-2 bg-gray-100 border shadow-sm border-slate-200 placeholder-gray-400 focus:outline-none focus:border-gray-300 focus:ring-gray-300 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Informasi Lainnya" />
                        </div>
                        <label class="block mb-6">
                            <span class="mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-poppins text-slate-700">
                                Rincian Informasi yang Dibutuhkan
                            </span>
                            <input type="text" required id="requiredInformation" name="requiredInformation" class="mt-1 px-3 py-2 bg-gray-100 border shadow-sm border-slate-200 placeholder-gray-400 focus:outline-none focus:border-gray-300 focus:ring-gray-300 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan Rincian Informasi yang Dibutuhkan" />
                        </label>
                        <label class="block mb-3">
                            <span class="mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-poppins text-slate-700">
                              Tujuan Penggunaan Informasi
                            </span>
                        </label>
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center">
                              <input type="checkbox" id="ForResearch" name="ForResearch" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                              <label for="ForResearch" class="ml-2 font-poppins text-sm text-slate-700">Untuk Penelitian/Tugas Akhir/Tesis dan sejenisnya</label>
                            </div>
                          
                            <div class="flex items-center">
                              <input type="checkbox" id="ForStudyProject" name="ForStudyProject" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                              <label for="ForStudyProject" class="ml-2 font-poppins text-sm text-slate-700">Untuk Studi/Kajian/Proyek</label>
                            </div>

                            <input required type="text" id="otherPurpose" name="otherPurpose" class="mt-1 px-3 py-2 bg-gray-100 border shadow-sm border-slate-200 placeholder-gray-400 focus:outline-none focus:border-gray-300 focus:ring-gray-300 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Lainnya" />
                        </div>
                          
                        <button type="submit" class="font-bold w-20 h-10 mt-1 px-3 py-2 bg-blue-800 border shadow-sm border-blue-800 block rounded-md sm:text-sm text-white hover:bg-blue-900 hover:text-white">
                            Kirim
                        </button>
                    </fieldset>
                </form>
            </div>
        </div>
    </main>
    <!-- End Main -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>