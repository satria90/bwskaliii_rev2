<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <title>BWSKAL III | Dashboard</title>
    <link rel="icon" href="{{ asset('assets/logo/logoPU.png') }}" type="image/png">
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

        {{--Navigasi--}}
        @include('components.navigator')

        {{-- Content --}}

        @role('client')    
        @if(!$approval || !$approval->proof || !$approval->idNumber)
            <div class="p-6">
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-lg w-auto">
                    <h1 class="text-2xl mb-4 font-bold text-slate-700">
                        Selamat Datang di Pelayanan Permohonan Data dan Informasi BWS KAL III
                    </h1>
                    <div class="text-base font-normal mb-4">
                        Lengkapi profil Anda untuk melanjutkan permohonan. 
                        <a href="{{route('profile.edit')}}" 
                        class="underline text-blue-600 hover:text-blue-800 transition duration-200">
                            Lengkapi Profil
                        </a>.
                    </div>
                </div>
            </div>
        @endif
        @endrole

        @role('client')    
        @if($approval && $approval->proof && $approval->idNumber)
            @if($approval->upload == 1)
                <!-- Pilihan Pelayanan -->
                <div class="p-6">
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-lg w-auto">
                        <div class="text-lg font-bold text-black">
                            Permohonan Data dan Informasi
                        </div>
                        <p class="text-base font-normal mb-4">
                            Ajukan permohonan data atau informasi dengan mudah melalui layanan kami. 
                            <a href="{{route('admin.data_requests.index')}}" 
                            class="underline text-blue-600 hover:text-blue-800 transition duration-200">
                                Pilih layanan
                            </a>.
                        </p>
                    </div>
                </div>
            @else
                <!-- Status Proses -->
                <div class="p-6">
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-lg w-auto">
                        <div class="text-lg font-medium text-gray-700 text-center">
                            Data Anda sedang diproses oleh pihak BWS KAL III.
                        </div>
                    </div>
                </div>
            @endif
        @endif
        @endrole


        {{-- dashboard admin --}}
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
                            <div class="text-2xl font-semibold mb-1">{{ $totalRequests }}</div>
                            <div class="text-sm font-medium text-gray-400">Jumlah Survey</div>
                            <!-- Tombol Download Survey -->
                            <form action="{{ route('survey.export-excel') }}" method="GET">
                                @csrf
                                <button type="submit" class="bg-green-500 p-2 mt-4 rounded-lg hover:bg-green-300 text-sm">
                                    Download Survey
                                </button>
                            </form>
                        </div>                     
                        <div class="ri-folders-line text-5xl text-blue-800 "></div>
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
        // Menyimpan data chart ke dalam objek global
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