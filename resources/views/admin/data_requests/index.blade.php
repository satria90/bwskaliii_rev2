<!DOCTYPE html>
<html lang="en">
<head>
    @vite('resources/css/app.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('dist\css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <title>Dashboard</title>
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
                <li class="mr-2">
                    <button type="button">
                        <a href="{{ route('profile.edit') }}">
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-8 h-8 rounded block object-cover align-middle">
                        </a>
                    </button>
                </li>
            </ul>
        </div>
        <!-- Navbar End -->
        <div class="p-6">
            <h1 class="font-poppins font-bold text-xl">Permohonan Data</h1>
            <p class="font-poppins text-gray-400">Permohonan data balai wilayah sungai Kalimantan III Banjarmasin</p>
        </div>
        <div class="px-6 py-2">
            <div class="bg-white rounded-md border border-gray-100 shadow-black/5 p-6">
                @role('client')
                <a href="{{ route('admin.data_requests.create') }}" class="font-medium text-center w-40 h-10 mt-1 px-3 py-2 bg-blue-700 border shadow-sm border-blue-800 block rounded-md sm:text-sm text-white hover:bg-blue-900 hover:text-white">
                Buat Permohonan
                </a>
                @endrole
                <!--Pagination -->

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 mt-5">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Masuk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target Selesai</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perbarui</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Baris Data -->
                            @forelse($dataRequest as $request)
                            <tr>
                                @if($request->Status == 'diproses')
                                <td class="px-6 py-4 whitespace-nowrap"><span class="font-medium text-center w-40 h-10 mt-1 px-3 py-2 bg-orange-100 border shadow-sm border-orange-50 block rounded-md sm:text-sm text-orange-400">Diproses</span></td>
                                @elseif($request->Status == 'ditolak')
                                <td class="px-6 py-4 whitespace-nowrap"><span class="font-medium text-center w-40 h-10 mt-1 px-3 py-2 bg-red-100 border shadow-sm border-red-50 block rounded-md sm:text-sm text-red-400">Ditolak</span></td>
                                @elseif($request->Status == 'diterima')
                                <td class="px-6 py-4 whitespace-nowrap"><span class="font-medium text-center w-40 h-10 mt-1 px-3 py-2 bg-green-100 border shadow-sm border-green-50 block rounded-md sm:text-sm text-green-400">Diterima</span></td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap">{{ $request->user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $request->created_at->timezone('Asia/Jakarta')->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $request->created_at->addDays(7)->timezone('Asia/Jakarta')->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @role('admin|owner')
                                    <br><a href="{{ route('admin.data_requests.upload', $request) }}" class="text-blue-600 hover:underline"><i class="ri-upload-cloud-line"></i> Unggah</a>
                                    <br><a download href="{{ Storage::url($request->fileDataRequest) }}" class="text-purple-500 hover:underline"><i class="ri-download-cloud-line"></i> Unduh</a>
                                    @endrole
                                    @role('client')
                                    {{-- Kondisi survey --}}
                                    @if($request->Status === 'diterima' && !$request->is_Proof)
                                        <a href="{{ route('admin.surveys.create') }}?dataRequestId={{ $request->id }}" class="text-green-400 hover:underline">
                                            <i class="ri-download-cloud-line"></i> Unduh
                                        </a>
                                    @elseif($request->is_Proof)
                                        <a download href="{{ Storage::url($request->fileDataRequest) }}" class="text-purple-500 hover:underline">
                                            <i class="ri-download-cloud-line"></i> Unduh
                                        </a>
                                    @endif

                                    @endrole
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.data_requests.show', $request) }}" class="text-stone-700 hover:underline"><i class="ri-eye-line"></i> Rincian</a>
                                    @role('admin|owner')
                                    <br><a href="{{ route('admin.data_requests.edit', $request) }}" class="text-amber-600 hover:underline"><i class="ri-edit-2-line"></i> Sunting</a>
                                    <form action="{{ route('admin.data_requests.destroy', $request) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <br><button type="submit" class="text-red-600 hover:underline"><i class="ri-delete-bin-line"></i> Hapus</button>
                                    </form>
                                    @endrole
                                </td>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">
                                        Belum ada data ditambahkan
                                    </td>
                                </tr>
                            @endforelse
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pagination mt-4">
                    {{ $dataRequest->appends(request()->query())->links('vendor.pagination.custom-tailwind') }}
                </div>
            </div>
        </div>
    </main>
    <!-- End Main -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>