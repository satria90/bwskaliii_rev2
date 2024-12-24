<div class="py-3 px-7 bg-white flex items-center shadow-md shadow-gray-400 sticky top-0 left-0 z-30">
    <button type="button" class="text-3xl mr-2 text-gray-600 sidebar-toggle">
        <i class="ri-menu-line"></i>
    </button>
    <ul class="flex items-center text-base ml-1 ">
        <li class="font-poppins mr-2">
            <a href="{{ route('dashboard') }}" class="text-2xl ri-home-2-line hover:text-gray-500">Beranda</a>
        </li>
        <li class="mr-2 ml-2">
            <form method="POST" action="{{ route('logout') }}" style="display: none;" id="logout-form">
                @csrf
            </form>
            <a href="logout" class="text-2xl ri-logout-box-r-line font-poppins hover:text-gray-500"
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
                    Auth::user()->avatar  ? (str_starts_with(Auth::user()->avatar, 'avatar/')
                    ? Storage::url(Auth::user()->avatar) : asset(Auth::user()->avatar)) 
                    : asset('assets/img/avatar-default.png') }}"  
                    class="w-11 h-11 rounded-full block object-cover align-middle">
                </a>
            </button>
        </li>
    </ul>
</div>