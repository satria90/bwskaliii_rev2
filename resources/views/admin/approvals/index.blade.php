<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('../dist/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css">
    <title>BWSKAL III | Pengelolaan Akun</title>
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
            <li class="font-poppins mb-1 group">
                <a href="{{ route('admin.data_requests.index') }}" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:text-gray-300 ">
                    <i class="ri-foggy-line mr-1 text-lg"></i>
                    <span>Permohonan</span>
                </a>
            </li>
            <li class="font-poppins mb-1 group active">
                <a href="#" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:bg-gray-300 group-[.active]:text-blue-900 ">
                    <i class="ri-team-line mr-3 text-lg"></i>
                    <span>Manajemen Akun</span>
                </a>
            </li>
            <li class="font-poppins mb-1 group">
                <a href="{{ route('admin.admins.index') }}" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:text-gray-300 ">
                    <i class="ri-group-line mr-3 text-lg"></i>
                    <span>Manajemen Admin</span>
                </a>
            </li>
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
                    <a href="{{ route('dashboard') }}" class="text-xl ri-home-2-line hover:text-gray-500">Beranda</a>
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

        {{-- Konten --}}
        <div class="p-6">
            <h1 class="font-poppins font-bold text-xl">Form Label Data</h1>
            <p class="font-poppins text-gray-400">Diharapkan  memverifikasi dengan benar</p>
        </div>
        <div class="px-6 py-2">
            <div class="bg-white rounded-md border border-gray-100 shadow-black/5 p-6">
                {{-- tabel user --}}
                <div class="overflow-x-auto">
                    <table id="myTable" class="min-w-full divide-y divide-gray-600 mt-5">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Surel</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diunggah Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Baris Data -->
                            @forelse($approvals as $approval)
                            <tr>
                                <!-- Kolom Avatar dan Nama -->
                                <td class="px-6 py-4  whitespace-nowrap flex items-center">
                                    {{ $approval->user->email }}
                                </td>

                                <!-- Kolom Tanggal Dibuat -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $approval->created_at->setTimezone('Asia/Makassar')->format('Y-m-d H:i:s') }}
                                </td>

                                {{-- Kolom Status --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    @if($approval->upload)
                                    <span class="text-sm font-bold py-2 px-3 rounded-full bg-green-100 text-green-500">
                                        Aktif
                                    </span>
                                    @else
                                    <span class="text-sm font-bold py-2 px-3 rounded-full bg-orange-100 text-orange-400">
                                        Menunggu
                                    </span>
                                    @endif
                                </td>
                                {{-- <td class="text-stone-700 hover:underline">
                                    <a href="{{ route('admin.approvals.show',$approval) }}" class="ri-eye-line">
                                        edit
                                    </a>
                                </td> --}}
                                <td class="text-stone-700">
                                    <a href="{{ route('admin.approvals.show',$approval) }}" class="ri-eye-line hover:underline text-stone-700">
                                        Rincian
                                    </a>
                                    <br>
                                    {{-- <a href="{{ route('admin.approvals.edit',$approval) }}" class="ri-edit-2-line hover:underline text-amber-600">
                                        Sunting
                                    </a> --}}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada data masuk
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script>
         $(document).ready(function() {
            $('#myTable').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    zeroRecords: "Tidak ditemukan data yang sesuai",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    }
                }
            });
        });
    </script>
</body>
</html>