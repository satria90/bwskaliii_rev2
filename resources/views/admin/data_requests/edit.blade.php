<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('dist\css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <title>BWSKAL III | Sunting Permohonan</title>
    <link rel="icon" href="{{ asset('assets/logo/logoPU.png') }}" type="image/png">
    @vite('resources/css/app.css')
     <style>
        .dropdown-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.6s ease, opacity 0.6s ease;
            opacity: 0;
        }
        .dropdown-open {
            max-height: 500px; /* Atur tinggi maksimum yang sesuai */
            opacity: 1;
        }
    </style>
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
                <a href="#" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:bg-gray-300 group-[.active]:text-blue-900">
                    <i class="ri-foggy-line mr-1 text-lg"></i>
                    <span>Permohonan</span>
                </a>
            </li>
            @role('admin|owner')
            <li class="font-poppins mb-1 group">
                <a href="{{ route('admin.approvals.index') }}" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:text-gray-300">
                    <i class="ri-team-line mr-3 text-lg"></i>
                    <span>Manajemen Akun</span>
                </a>
            </li>
            @endrole
            @role('owner')
            <li class="font-poppins mb-1 group">
                <a href="{{ route('admin.admins.index') }}" class="flex items-center px-2 py-2 text-gray-400 hover:bg-gray-300 hover:text-blue-800 rounded-full group-[.active]:text-gray-300">
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
        <div class="px-6 py-2">
            <div class="bg-white rounded-md border border-gray-100 shadow-black/5 p-6">
                <form method="POST" action="{{ route('admin.data_requests.update',$dataRequest ) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <fieldset>
                        <h1 class="text-2xl font-bold mb-6">Pengajuan Permohonan dan Informasi</h1>
                        <p class="mb-3 text-lg font-semibold text-gray-500 after:content-['*'] after:ml-0.5 after:text-red-500">Silahkan Pilih Permohonan dan Informasi</p>
        
                        <div class="mb-3">
                            <button
                                type="button"
                                class="w-full flex justify-between items-center bg-gray-100 px-4 py-2 text-left rounded-md shadow focus:outline-none focus:ring focus:ring-blue-300"
                                onclick="toggleCollapse('dropdown1')">
                                <span class="font-bold text-slate-700">Informasi Perizinan Penggunaan SDA</span>
                                <i id="icon-dropdown1" class="ri-arrow-down-s-line text-slate-700 transition-transform"></i>
                            </button>
                            <div id="dropdown1" class="dropdown-content mt-4">
                                <label for="fileDataPerizinan" class="block mb-2 text-sm font-poppins text-slate-700">
                                    Upload surat permohonan
                                </label>
                                <input type="file" id="fileDataPerizinan" name="fileDataPerizinan" class="block w-full mb-4 border border-gray-300 rounded-md p-2 text-sm text-slate-700">
                                <label class="block mb-3">
                                    <span class="mb-2 block text-sm font-poppins text-slate-700">Jenis Informasi yang Dibutuhkan</span>
                                </label>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input {{ $dataRequest->UnoperatedPermission == 1 ? 'checked' : '' }} type="checkbox" id="UnoperatedPermission" name="UnoperatedPermission" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="UnoperatedPermission" class="ml-2 font-poppins text-sm text-slate-700">Perizinan Untuk perusahaan/kegiatan yang belum beroperasi</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input {{ $dataRequest->OperatedPermission == 1 ? 'checked' : '' }} type="checkbox" id="OperatedPermission" name="OperatedPermission" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="OperatedPermission" class="ml-2 font-poppins text-sm text-slate-700">Perizinan Untuk perusahaan/kegiatan yang telah beroperasi</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input {{ $dataRequest->RiverDiversion == 1 ? 'checked' : '' }} type="checkbox" id="RiverDiversion" name="RiverDiversion" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="RiverDiversion" class="ml-2 font-poppins text-sm text-slate-700">Pemindahan Alur Sungai</label>
                                    </div>
                                </div>
                            </div>
                        </div>                        
        
                        <!-- Dropdown 2 -->
                        <div class="mb-3">
                            <button type="button" class="w-full flex justify-between items-center bg-gray-100 px-4 py-2 text-left rounded-md shadow focus:outline-none focus:ring focus:ring-blue-300"
                                onclick="toggleCollapse('dropdown2')">
                                <span class="font-bold text-slate-700">Permohonan Surat Keterangan Ketersediaan Air & Rekomendasi Teknis Galian C</span>
                                <i id="icon-dropdown2" class="ri-arrow-down-s-line text-slate-700 transition-transform"></i>
                            </button>
                            <div id="dropdown2" class="dropdown-content mt-4">
                                <label for="fileDataRekomtek" class="block mb-2 text-sm font-poppins text-slate-700">
                                    Upload surat permohonan
                                </label>
                                <input type="file" id="fileDataRekomtek" name="fileDataRekomtek" class="block w-full mb-4 border border-gray-300 rounded-md p-2 text-sm text-slate-700">
                                <label class="block mb-3">
                                    <span class="mb-2 block text-sm font-poppins text-slate-700">Pilih Surat Keterangan yang dibutuhkan</span>
                                </label>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input {{ $dataRequest->WaterAvailability == 1 ? 'checked' : '' }} type="checkbox" id="WaterAvailability" name="WaterAvailability" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="WaterAvailability" class="ml-2 font-poppins text-sm text-slate-700">Ketersediaan Air</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input {{ $dataRequest->MinerC == 1 ? 'checked' : '' }} type="checkbox" id="MinerC" name="MinerC" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="MinerC" class="ml-2 font-poppins text-sm text-slate-700">Galian C</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Dropdown 3 -->
                        <div class="mb-3">
                            <button type="button" class="w-full flex justify-between items-center bg-gray-100 px-4 py-2 text-left rounded-md shadow focus:outline-none focus:ring focus:ring-blue-300"
                                onclick="toggleCollapse('dropdown3')">
                                <span class="font-bold text-slate-700">Permohonan Data dan Informasi SDA</span>
                                <i id="icon-dropdown1" class="ri-arrow-down-s-line text-slate-700 transition-transform"></i>
                            </button>
                            <div id="dropdown3" class="dropdown-content mt-4">
                                <label for="fileDataSda" class="block mb-2 text-sm font-poppins text-slate-700">
                                    Upload surat permohonan
                                </label>
                                <input type="file" id="fileDataSda" name="fileDataSda" class="block w-full mb-4 border border-gray-300 rounded-md p-2 text-sm text-slate-700">
                                <label class="block mb-3">
                                    <span class="mb-2 block text-sm font-poppins text-slate-700">Jenis Permohonan data atau Informasi yang Dibutuhkan</span>
                                </label>
                                <div class="flex flex-wrap gap-4">
                                    <!-- Kolom 1 -->
                                    <div class="space-y-2 w-1/2">
                                        <div class="flex items-center">
                                            <input {{ $dataRequest->RainFall == 1 ? 'checked' : '' }} type="checkbox" id="RainFall" name="RainFall" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="RainFall" class="ml-2 font-poppins text-sm text-slate-700">Curah Hujan</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input {{ $dataRequest->WaterHeight == 1 ? 'checked' : '' }} type="checkbox" id="WaterHeight" name="WaterHeight" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="WaterHeight" class="ml-2 font-poppins text-sm text-slate-700">Tinggi Muka Air</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input {{ $dataRequest->Climatology == 1 ? 'checked' : '' }} type="checkbox" id="Climatology" name="Climatology" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="Climatology" class="ml-2 font-poppins text-sm text-slate-700">Klimatologi</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input {{ $dataRequest->WaterQuality == 1 ? 'checked' : '' }} type="checkbox" id="WaterQuality" name="WaterQuality" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="WaterQuality" class="ml-2 font-poppins text-sm text-slate-700">Kualitas Air</label>
                                        </div>
                                    </div>
                                
                                    <!-- Kolom 2 -->
                                    <div class="space-y-2 w-1/2">
                                        <div class="flex items-center">
                                            <input {{ $dataRequest->WaterBalance == 1 ? 'checked' : '' }} type="checkbox" id="WaterBalance" name="WaterBalance" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="WaterBalance" class="ml-2 font-poppins text-sm text-slate-700">Neraca Air</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input {{ $dataRequest->RiverNetwork == 1 ? 'checked' : '' }} type="checkbox" id="RiverNetwork" name="RiverNetwork" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="RiverNetwork" class="ml-2 font-poppins text-sm text-slate-700">Peta Jaringan Sungai</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input {{ $dataRequest->WaterDischarge == 1 ? 'checked' : '' }} type="checkbox" id="WaterDischarge" name="WaterDischarge" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="WaterDischarge" class="ml-2 font-poppins text-sm text-slate-700">Debit Sesaat</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input {{ $dataRequest->WatershedMap == 1 ? 'checked' : '' }} type="checkbox" id="WatershedMap" name="WatershedMap" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="WatershedMap" class="ml-2 font-poppins text-sm text-slate-700">Peta DAS dan Sub DAS</label>
                                        </div>
                                    </div>
                                </div>                                                                        
                            </div>
                        </div>

                            <!-- Dropdown 4 -->
                            <div class="mb-3">
                                <button type="button" class="w-full flex justify-between items-center bg-gray-100 px-4 py-2 text-left rounded-md shadow focus:outline-none focus:ring focus:ring-blue-300" onclick="toggleCollapse('dropdown4')">
                                    <span class="font-bold text-slate-700">Permohonan Peminjaman Sarana Prasarana BWS Kalimantan III Banjarmasin</span>
                                    <i id="icon-dropdown4" class="ri-arrow-down-s-line text-slate-700 transition-transform"></i>
                                </button>
                                <div id="dropdown4" class="dropdown-content mt-4">
                                    <!-- Label untuk upload file -->
                                    <label for="fileDataPeminjaman" class="block mb-2 text-sm font-poppins text-slate-700">
                                        Upload surat permohonan
                                    </label>
                                    <input type="file" id="fileDataPeminjaman" name="fileDataPeminjaman" class="block w-full mb-4 border border-gray-300 rounded-md p-2 text-sm text-slate-700">

                                    <!-- Label untuk textarea -->
                                    <div>
                                    <label class="block text-sm font-poppins" for="">Pilih sarana prasarana</label>
                                    </div>
                                    <div class="flex items-center mt-3">
                                        <input {{ $dataRequest->Tools == 1 ? 'checked' : '' }} type="checkbox" id="Tools" name="Tools" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="Tools" class="ml-2 font-poppins text-sm text-slate-700">Alat</label>
                                    </div>
                                    <div class="flex items-center mt-3">
                                        <input {{ $dataRequest->PumpsEquipment == 1 ? 'checked' : '' }} type="checkbox" id="PumpsEquipment" name="PumpsEquipment" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="PumpsEquipment" class="ml-2 font-poppins text-sm text-slate-700">Pompa dan Alat Berat</label>
                                    </div>
                                </div>
                            </div>

                           <!-- Dropdown 5 -->
                            <div class="mb-3">
                                <button type="button" class="w-full flex justify-between items-center bg-gray-100 px-4 py-2 text-left rounded-md shadow focus:outline-none focus:ring focus:ring-blue-300" onclick="toggleCollapse('dropdown5')">
                                    <span class="font-bold text-slate-700">Pengaduan Masyarakat</span>
                                    <i id="icon-dropdown5" class="ri-arrow-down-s-line text-slate-700 transition-transform"></i>
                                </button>
                                <div id="dropdown5" class="dropdown-content mt-4">
                                    <!-- Label untuk upload file -->
                                    <label for="fileDataPengaduan" class="block mb-2 text-sm font-poppins text-slate-700">
                                        Upload surat pengaduan
                                    </label>
                                    <input type="file" id="fileDataPengaduan" name="fileDataPengaduan" class="block w-full mb-4 border border-gray-300 rounded-md p-2 text-sm text-slate-700">

                                    <!-- Label untuk textarea -->
                                    <label for="Information" class="block mb-2 text-sm font-poppins text-slate-700">
                                        Keterangan
                                    </label>
                                    <textarea value="{{ $dataRequest->Information }}" id="Information" name="Information" rows="4" class="block w-full border border-gray-300 rounded-md p-2 text-sm text-slate-700"></textarea>
                                </div>
                            </div>
        
                            <label class="block mb-6">
                                <span class="mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 block text-lg font-poppins text-gray-500 font-semibold">
                                    Rincian Informasi yang Dibutuhkan
                                </span>
                                <input value="{{ $dataRequest->requiredInformation }}" type="text" required id="requiredInformation" name="requiredInformation" class="mt-1 px-3 py-2 bg-gray-100 border shadow-sm border-slate-200 placeholder-gray-400 focus:outline-none focus:border-gray-300 focus:ring-gray-300 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan Rincian Informasi yang Dibutuhkan" />
                            </label>
            
                            <label class="block mb-3">
                                <span class="mb-2 after:content-['*'] after:ml-0.5 after:text-red-500 block text-lg font-semibold font-poppins text-gray-500">
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
            
                                <input value="{{ $dataRequest->otherPurpose }}" required type="text" id="otherPurpose" name="otherPurpose" class="mt-1 px-3 py-2 bg-gray-100 border shadow-sm border-slate-200 placeholder-gray-400 focus:outline-none focus:border-gray-300 focus:ring-gray-300 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Lainnya" />
                            </div>
                            <input type="hidden" name="status" value="diproses">

                            <div class="flex space-x-2 mb-8">
                                <!-- Diterima Button -->
                                <label>
                                    <input 
                                        type="radio" 
                                        name="Status" 
                                        value="diterima" 
                                        class="hidden peer" 
                                        {{ old('Status', $dataRequest->Status ?? '') == 'diterima' ? 'checked' : '' }}>
                                    <span class="px-4 py-2 rounded-md cursor-pointer peer-checked:bg-yellow-500 peer-checked:text-white hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                        Diterima
                                    </span>
                                </label>
                                
                                <!-- Ditolak Button -->
                                <label>
                                    <input 
                                        type="radio" 
                                        name="Status" 
                                        value="ditolak" 
                                        class="hidden peer" 
                                        {{ old('Status', $dataRequest->Status ?? '') == 'ditolak' ? 'checked' : '' }}>
                                    <span class="px-4 border-4 border-red-400 py-2 rounded-md cursor-pointer peer-checked:bg-red-500 peer-checked:text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500">
                                        Ditolak
                                    </span>
                                </label>
                            </div>
                            
                            
                            
                            <!-- Hidden Input for Status -->
                            <input type="hidden" id="status-input" name="status" value="draft">
                            
                           
                            

            
                            <!-- Tombol Submit -->
                            <button type="submit" class="font-bold w-20 h-10 mt-1 px-2 py-2 bg-blue-800 border shadow-sm border-blue-800 block rounded-md sm:text-sm text-white hover:bg-blue-900 hover:text-white">
                                Perbarui
                            </button>
                        </fieldset>
                    </form>
                </div>
            </div>            
    </main>
    {{-- <script>
        function setStatus(status) {
            // Update hidden input value
            document.getElementById('status-input').value = status;
    
            // Reset all button styles
            document.getElementById('draft-btn').classList.remove('ring-2', 'ring-offset-2', 'ring-blue-400');
            document.getElementById('scheduled-btn').classList.remove('ring-2', 'ring-offset-2', 'ring-yellow-400');
            document.getElementById('published-btn').classList.remove('ring-2', 'ring-offset-2', 'ring-green-400');
    
            // Highlight selected button
            if (status === 'draft') {
                document.getElementById('draft-btn').classList.add('ring-2', 'ring-offset-2', 'ring-blue-400');
            } else if (status === 'scheduled') {
                document.getElementById('scheduled-btn').classList.add('ring-2', 'ring-offset-2', 'ring-yellow-400');
            } else if (status === 'published') {
                document.getElementById('published-btn').classList.add('ring-2', 'ring-offset-2', 'ring-green-400');
            }
        }
    </script> --}}
    <script>
        // Fungsi toggle manual
        function toggleCollapse(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const icon = document.querySelector(`#icon-${dropdownId}`);
    
            // Toggle visibility
            dropdown.classList.toggle('dropdown-open');
    
            // Rotate icon
            if (dropdown.classList.contains('dropdown-open')) {
                icon.style.transform = 'rotate(180deg)';
            } else {
                icon.style.transform = 'rotate(0deg)';
            }
        }
    
        // Fungsi otomatis membuka dropdown dengan data
        document.addEventListener('DOMContentLoaded', function () {
            function autoOpenDropdown(dropdownId, hasData) {
                const dropdown = document.getElementById(dropdownId);
                const icon = document.querySelector(`#icon-${dropdownId}`);
    
                if (hasData) {
                    dropdown.classList.add('dropdown-open'); // Buka dropdown
                    icon.style.transform = 'rotate(180deg)'; // Putar ikon panah
                }
            }
    
            // Periksa kondisi untuk setiap dropdown
            autoOpenDropdown('dropdown1', 
                document.querySelector('#UnoperatedPermission:checked') || 
                document.querySelector('#OperatedPermission:checked') || 
                document.querySelector('#RiverDiversion:checked')
            );
    
            autoOpenDropdown('dropdown2', 
                document.querySelector('#WaterAvailability:checked') || 
                document.querySelector('#MinerC:checked')
            );
    
            autoOpenDropdown('dropdown3', 
                document.querySelector('#RainFall:checked') || 
                document.querySelector('#WaterHeight:checked') || 
                document.querySelector('#Climatology:checked') || 
                document.querySelector('#WaterQuality:checked') || 
                document.querySelector('#WaterBalance:checked') || 
                document.querySelector('#RiverNetwork:checked') || 
                document.querySelector('#WaterDischarge:checked') || 
                document.querySelector('#WatershedMap:checked')
            );
    
            autoOpenDropdown('dropdown4', 
                document.querySelector('#Tools:checked') || 
                document.querySelector('#PumpsEquipment:checked')
            );
    
            autoOpenDropdown('dropdown5', 
                document.getElementById('Information').value.trim() !== ''
            );
        });
    </script>       
    <script src="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>