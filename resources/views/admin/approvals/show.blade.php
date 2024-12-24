<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('dist\css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <title>BWSKAL III | Detail Akun</title>
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
                <a href="{{ route('admin.approvals.index') }}" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:bg-gray-300 group-[.active]:text-blue-900 ">
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
        @include('components.navigator')
        <!-- Navbar End -->
       
        {{-- Konten --}}
        <div class="p-6">
            <h1 class="font-poppins font-bold text-xl">Kelola Data Pemohon</h1>
            <p class="font-poppins text-gray-400">Diharapkan  memverifikasi dengan benar</p>
        </div>
        <main class="flex-grow container mx-auto px-6 py-4">
            <div class="bg-white rounded-md border border-gray-100 shadow-md">
                <!-- Title Section -->
                {{-- <div class="bg-blue-700 text-white p-4 rounded-b-md">
                    <h2 class="text-xl font-bold">Profil Data Diri</h2>
                </div> --}}
    
                <!-- Body Section -->
                {{-- <div class="p-6">
                    <table class="table-auto w-full  ">
                        <tbody>
                          
                            <tr class="">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Nama Lengkap</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->user->fullName }}</td>
                            </tr>

                            <tr>
                                <td class="px-4 py-2 font-semibold text-gray-700">Foto Profil</td>
                                <td class="px-4 py-2 text-gray-600">
                                    <a href="{{ Storage::url($approval->user->avatar) }}" target="_blank" class="text-blue-500 hover:underline">
                                        Lihat File
                                    </a>
                                </td>
                            </tr>


                            <tr class="">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Alamat</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->user->homeAddress }}</td>
                            </tr>
                       
                            <tr class="bg-white">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Pekerjaan</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->user->occupation }}</td>
                            </tr>

                            <tr class="bg-white">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Nama Perusahaan</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->user->companyName }}</td>
                            </tr>
                            <tr class="bg-white">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Alamat Perusahaan</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->user->companyAddress }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}
                
                {{-- <!-- Footer Section -->
                <div class="bg-gray-100 p-4 rounded-b-md">
                    <hr class="my-5">

                </div> --}}
            </div>
            <div class="bg-white rounded-md border border-gray-100 shadow-md ">
                <!-- Title Section -->
                <div class="bg-blue-700 text-white p-4 rounded-b-md">
                    <h2 class="text-xl font-bold">Profil Data ID</h2>
                </div>
    
                <!-- Body Section -->
                <div class="p-6">
                    <table class="table-auto w-full  ">
                        <tbody>
                            <!-- Baris 1 -->
                            <tr class="">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Nomor Identitas (NIK)</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->idNumber }}</td>
                            </tr>

                            <tr class="">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Nama Lengkap</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->user->name }}</td>
                            </tr>
                            <!-- Baris 2 -->
                            <tr class="bg-white">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Alamat Surel</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->user->email }}</td>
                            </tr>

                            <tr class="bg-white">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Nomor Telepon</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->user->phoneNumber }}</td>
                            </tr>
                            
                            <tr class="">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Alamat</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->user->homeAddress }}</td>
                            </tr>

                            <tr class="bg-white">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Pekerjaan</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->user->occupation }}</td>
                            </tr>

                            <tr class="bg-white">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Nama Perusahaan</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->user->companyName }}</td>
                            </tr>

                            <tr class="bg-white">
                                <td class=" px-4 py-2 font-semibold text-gray-700">Alamat Perusahaan</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->user->companyAddress }}</td>
                            </tr>

                            <!-- Baris 3 -->
                            <tr>
                                <td class="px-4 py-2 font-semibold text-gray-700">Kartu Identitas (KTP)</td>
                                <td class="px-4 py-2 text-gray-600">
                                    <a href="{{ Storage::url($approval->proof) }}" target="_blank" class="text-blue-500 hover:underline">
                                        Lihat File
                                    </a>
                                </td>
                            </tr>
                            <!-- Baris 4 -->
                            <tr>
                                <td class=" px-4 py-2 font-semibold text-gray-700">Kartu Identitas Diunggah Tanggal</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->updated_at->setTimezone('Asia/Makassar')->format('Y-m-d H:i:s') }}</td>
                            </tr>
                            <!-- Baris 5 -->
                            <tr>
                                <td class=" px-4 py-2 font-semibold text-gray-700">Identitas Divalidasi Tanggal</td>
                                <td class=" px-4 py-2 text-gray-600">{{ $approval->approval_start_date }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Footer Section -->
                <div class="bg-gray-100 p-4 rounded-b-md">
                    @if($approval->upload)
                    Sudah Terverifikasi
                    @else
                    <hr class="my-5">
                    <form action="{{ route('admin.approvals.update', $approval) }}" method="POST">
                        @csrf
                        @method('put')
                        <button type="submit" class="font-medium text-center w-40 h-10 mt-1 px-3 py-2 bg-blue-700 border shadow-sm border-blue-800 block rounded-md sm:text-sm text-white hover:bg-blue-900 hover:text-white">
                            Terima 
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </main>
    </main>
    <!-- End Main -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>