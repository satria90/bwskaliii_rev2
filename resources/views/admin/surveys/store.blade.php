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
        @include('components.navigator')
        <!-- Navbar End -->

        <!-- Konten -->
        <div class="p-6">
            <h1 class="font-poppins font-bold text-xl">Form Permohonan Data</h1>
            <p class="font-poppins text-gray-400">Diharapkan  user mengisi data dengan lengkap</p>
        </div>
        
        <div class="px-6 py-2">
            <div class="bg-white rounded-md border border-gray-100 shadow-black/5 p-6">
                <form method="POST" action="{{ route('admin.data_requests.update',$dataRequest ) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @role('admin|owner')
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
                              <input {{ $dataRequest->Rainfall == 1 ? 'checked' : '' }} type="checkbox" id="Rainfall" name="Rainfall" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                              <label for="ch" class="ml-2 font-poppins text-sm text-slate-700">Curah Hujan</label>
                            </div>
                          
                            <div class="flex items-center">
                              <input {{ $dataRequest->RiverProfile == 1 ? 'checked' : '' }} type="checkbox" id="RiverProfile" name="RiverProfile" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                              <label for="RiverProfile" class="ml-2 font-poppins text-sm text-slate-700">Profil Sungai</label>
                            </div>
                          
                            <div class="flex items-center">
                              <input {{ $dataRequest->Topography == 1 ? 'checked' : '' }} type="checkbox" id="Topography" name="Topography" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                              <label for="Topography" class="ml-2 font-poppins text-sm text-slate-700">Topografi</label>
                            </div>

                            <div class="flex items-center">
                                <input {{ $dataRequest->StudyResearch == 1 ? 'checked' : '' }} type="checkbox" id="StudyResearch" name="StudyResearch" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="StudyResearch" class="ml-2 font-poppins text-sm text-slate-700">Studi/Kajian</label>
                            </div>

                            <div class="flex items-center">
                                <input {{ $dataRequest->WaterAllocation == 1 ? 'checked' : '' }} type="checkbox" id="WaterAllocation" name="WaterAllocation" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="WaterAllocation" class="ml-2 font-poppins text-sm text-slate-700">Alokasi Air</label>
                            </div>

                            <input value="{{ $dataRequest->otherCheckbox }}" type="text" id="otherCheckbox" name="otherCheckbox" class="mt-1 px-3 py-2 bg-gray-100 border shadow-sm border-slate-200 placeholder-gray-400 focus:outline-none focus:border-gray-300 focus:ring-gray-300 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Informasi Lainnya" />
                        </div>
                        <label class="block mb-6">
                            <span class="mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-poppins text-slate-700">
                                Rincian Informasi yang Dibutuhkan
                            </span>
                            <input value="{{ $dataRequest->requiredInformation }}" type="text" required id="requiredInformation" name="requiredInformation" class="mt-1 px-3 py-2 bg-gray-100 border shadow-sm border-slate-200 placeholder-gray-400 focus:outline-none focus:border-gray-300 focus:ring-gray-300 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan Rincian Informasi yang Dibutuhkan" />
                        </label>
                        <label class="block mb-3">
                            <span class="mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-poppins text-slate-700">
                              Tujuan Penggunaan Informasi
                            </span>
                        </label>
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center">
                              <input {{ $dataRequest->ForResearch == 1 ? 'checked' : '' }} type="checkbox" id="ForResearch" name="ForResearch" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                              <label for="ForResearch" class="ml-2 font-poppins text-sm text-slate-700">Untuk Penelitian/Tugas Akhir/Tesis dan sejenisnya</label>
                            </div>
                          
                            <div class="flex items-center">
                              <input {{ $dataRequest->ForStudyProject == 1 ? 'checked' : '' }} type="checkbox" id="ForStudyProject" name="ForStudyProject" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                              <label for="ForStudyProject" class="ml-2 font-poppins text-sm text-slate-700">Untuk Studi/Kajian/Proyek</label>
                            </div>

                            <input value="{{ $dataRequest->otherPurpose }}" type="text" id="otherPurpose" name="otherPurpose" class="mt-1 px-3 py-2 bg-gray-100 border shadow-sm border-slate-200 placeholder-gray-400 focus:outline-none focus:border-gray-300 focus:ring-gray-300 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Lainnya" />
                        </div>
                        
                        <div class="space-y-2 mb-6">

                            <div class="flex items-center">
                                <input {{ $dataRequest->Status == 'diproses' ? 'checked' : '' }} type="radio" id="diproses" name="Status" value="diproses" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="diproses" class="ml-2 font-poppins text-sm text-slate-700">Diproses</label>
                            </div>
                        
                            <div class="flex items-center">
                                <input {{ $dataRequest->Status == 'diterima' ? 'checked' : '' }} type="radio" id="diterima" name="Status" value="diterima" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="diterima" class="ml-2 font-poppins text-sm text-slate-700">Diterima</label>
                            </div>
                        
                            <div class="flex items-center">
                                <input {{ $dataRequest->Status == 'ditolak' ? 'checked' : '' }} type="radio" id="ditolak" name="Status" value="ditolak" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="ditolak" class="ml-2 font-poppins text-sm text-slate-700">Ditolak</label>
                            </div>
                            
                        </div>
                        <div class="flex items-center gap-4">
                            <button type="submit" class="font-bold w-20 h-10 mt-1 px-2 py-2 bg-blue-800 border shadow-sm border-blue-800 block rounded-md sm:text-sm text-white hover:bg-blue-900 hover:text-white">
                                Perbarui
                            </button>
                        </div> 
                    </fieldset>
                    @endrole
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