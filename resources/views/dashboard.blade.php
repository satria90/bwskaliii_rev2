<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="text-gray-800 font-poppins bg-gray-100">
    
    <!-- Start Sidebar -->
     <div class="fixed left-0 top-0 w-64 h-full bg-white p-4 z-50 sidebar-menu transition-transform ">
        <a href="#home">
        <div class="flex items-center">
            <img src="../assets/logo/logo.png" alt="Logo-instansi">
        </div>
        </a>
        <ul class="mt-3">
            <li class="font-poppins mb-1 group active">
                <a href="#" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-950 rounded-full group-[.active]:bg-gray-300 group-[.active]:text-blue-900 ">
                    <i class="ri-computer-line mr-3 text-lg"></i>
                    <span>Beranda</span>
                </a>
            </li>
            @role('admin|owner')
            <li class="font-bold font-poppins mb-1">
                PELAYANAN
            </li>
            <li class="font-poppins mb-1 group ">
                <a href="{{ route('admin.data_requests.index') }}" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:text-gray-300 ">
                    <i class="ri-foggy-line mr-1 text-lg"></i>
                    <span>Permohonan</span>
                </a>
            </li>
            @endrole
            
            @role('client')
            @if($approval && $approval->upload == 1)
            <li class="font-bold font-poppins mb-1">
                PELAYANAN
            </li>
            <li class="font-poppins mb-1 group ">
                <a href="{{ route('admin.data_requests.index') }}" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:text-gray-300 ">
                    <i class="ri-foggy-line mr-1 text-lg"></i>
                    <span>Permohonan</span>
                </a>
            </li>
            @endif
            @endrole
            
        
            @role('admin|owner')
            <li class="font-poppins mb-1 group ">
                <a href="{{ route('admin.approvals.index') }}" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:text-gray-300 ">
                    <i class="ri-team-line mr-3 text-lg"></i>
                    <span>Manajemen Akun</span>
                </a>
            </li>
            @endrole
            @role('owner')
            <li class="font-poppins mb-1 group ">
                <a href={{ route('admin.admins.index') }} class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:text-gray-300 ">
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
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-11 h-11 rounded-full block object-cover align-middle">
                        </a>
                    </button>
                </li>
            </ul>
        </div>
        @role('client')    
        @if(!$approval || !$approval->proof || !$approval->idNumber)
            <div class="p-6">
                <h1 class="text-2xl mb-4 font-semibold text-slate-700">
                    Selamat Datang di Pelayanan Permohonan Data dan Informasi BWSKALIII
                </h1>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-lg w-80">
                    <div class="text-xl font-medium text-gray-500 mb-4 text-left">
                        Lengkapi profil anda untuk melanjutkan permohonan
                    </div>
                    <a href="{{route('profile.edit')}}" 
                       class="block w-auto bg-gray-400 text-gray-800 text-center px-4 py-2 rounded-md shadow hover:bg-gray-600 transition">
                        Lengkapi Profil
                    </a>
                </div>             
            </div>
        @endif
        @endrole
        @role('client')    
            @if($approval && $approval->proof && $approval->idNumber)
                @if($approval->upload == 1)
                    <!-- Tampilkan Pilihan Pelayanan -->
                    <div class="p-6">
                        <h1 class="text-2xl font-semibold mb-2">Silahkan pilih pelayanan yang tersedia</h1>
                        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-lg w-96">
                            <div class="text-lg font-bold text-gray-700">
                            Permohonan data dan informasi
                            </div>
                            <p class="text-sm font-normal mb-4">
                                Pelayanan yang memudahkan anda untuk mengajukan permohonan data atau permohonan informasi
                            </p>
                            <a href="{{route('admin.data_requests.index')}}" 
                            class="block w-auto bg-gray-400 text-gray-800 text-center px-4 py-2 rounded-md shadow hover:bg-gray-600 transition">
                                Pilih pelayanan
                            </a>
                        </div>             
                    </div>
                @else
                    <!-- Tampilkan Status Proses -->
                    <div class="p-6">
                        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-lg w-80">
                            <div class="text-2xl font-medium text-gray-700 text-center">
                                Data anda sedang diproses oleh pihak bwskaliii
                            </div>
                        </div>             
                    </div>
                @endif
            @endif
        @endrole
        @role('admin|owner')
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-md border border-gray-100 p-6">
                    <div class="flex justify-between">
                        <div>
                            <div class="text-2xl font-semibold mb-1">{{ $diproses }}</div>
                            <div class="text-sm font-medium text-gray-400">Diproses</div>
                        </div>                     
                        <div class="ri-send-plane-line text-5xl text-yellow-400 ">
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6">
                    <div class="flex justify-between">
                        <div>
                            <div class="text-2xl font-semibold mb-1">{{ $diterima }}</div>
                            <div class="text-sm font-medium text-gray-400">Diterima</div>
                        </div>                     
                        <div class="ri-check-double-fill text-5xl text-green-400 ">
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6">
                    <div class="flex justify-between">
                        <div>
                            <div class="text-2xl font-semibold mb-1">{{ $ditolak }}</div>
                            <div class="text-sm font-medium text-gray-400">Ditolak</div>
                        </div>                     
                        <div class="ri-close-large-fill text-5xl text-red-400 ">
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6">
                    <div class="flex justify-between">
                        <div>
                            <div class="text-base font-poppins font-bold mb-1">Panduan Aplikasi</div>
                            <div class="text-sm font-poppins text-gray-400 hover:text-blue-500"><a href="dowonload">Download</a></div>
                        </div>                     
                        <div class="ri-file-pdf-2-line text-5xl text-black ">
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @role('admin|owner')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-5">
                <div class="bg-white rounded-md border border-gray-100 p-6">
                    <div class="flex justify-between">
                        <div>
                            <div class="text-2xl font-semibold mb-1">{{ $totalRequests }}</div>
                            <div class="text-sm font-medium text-gray-400">Pesan Masuk</div>
                        </div>                     
                        <div class="ri-folders-line text-5xl text-blue-800 ">
                        </div>
                    </div>
                </div>
            </div>
            @endrole
        </div>
        @role('admin|owner')
        <div class="px-6 py-2">
            <div class="bg-white rounded-md border border-gray-100 shadow-black/5 p-6">
                <div class="p-6">
                    <h1 class="font-medium mb-6">Hasil Survey</h1>
                    <div class="space-y-4">
                        @foreach($questionsData as $questionKey => $questionData)
                            <p class="font-poppins text-gray-600">{{ $questionData['text'] }}</p>
                            <div class="relative w-full h-96 mb-2 flex items-center justify-center">
                            <canvas id="{{ $questionKey }}" class="w-full h-96"></canvas>
                            </div>
                        @endforeach
                    </div>
                </div>              
            </div>
        </div>
        @endrole
    </main>
    <!-- End Main -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
         // Membuat objek global untuk menyimpan data chart
        const chartData = [];

        @foreach($questionsData as $questionKey => $questionData)
            chartData.push({
                id: '{{ $questionKey }}',
                labels: @json($questionData['labels']),
                data: @json($questionData['data']),
                text: '{{ $questionData['text'] }}'
            });
        @endforeach
    </script>
</body>
</html>