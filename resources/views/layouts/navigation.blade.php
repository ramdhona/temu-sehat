<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 ">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @if (Auth::user()->role == 'dokter')
                        <a href="{{ route('dokter.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 " />
                        </a>
                    @elseif(Auth::user()->role == 'pasien')
                        <a href="{{ route('pasien.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 " />
                        </a>
                    @endif
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (Auth::user()->role == 'dokter')
                        <!-- Navigation link for Dokter Dashboard -->
                        <x-nav-link :href="route('dokter.dashboard')" :active="request()->routeIs('dokter.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        {{-- Menu link for "Obat" (Medicine) --}}
                        <x-nav-link :href="route('dokter.obat.index')" :active="request()->routeIs('dokter.obat.index')">
                            {{ __('Obat') }}
                        </x-nav-link>

                        {{-- Menu link for "Jadwal" (Schedule) --}}
                        <x-nav-link :href="route('dokter.jadwal.index')" :active="request()->routeIs('dokter.jadwal.index')">
                            {{ __('Jadwal') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dokter.memeriksa.index')" :active="request()->routeIs('dokter.memeriksa.index')">
                            {{ __('Memeriksa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dokter.riwayat-periksa.index')" :active="request()->routeIs('dokter.riwayat-periksa.index')">
                            {{ __('Riwayat Periksa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dokter.poli.index')" :active="request()->routeIs('dokter.poli.index')">
                            {{ __('Poli') }}
                        </x-nav-link>
                    @elseif(Auth::user()->role == 'pasien')
                        <x-nav-link :href="route('pasien.dashboard')" :active="request()->routeIs('pasien.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <!-- Link khusus pasien -->
                        <x-nav-link :href="route('pasien.janji-periksa.index')" :active="request()->routeIs('pasien.janji-periksa.index')">
                            {{ __('Janji Periksa') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pasien.riwayat-periksa.index')" :active="request()->routeIs('pasien.riwayat-periksa.index')">
                            {{ __('Riwayat Periksa') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <!-- User profile dropdown trigger button -->
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->nama }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Profile link -->
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Logout link with form submission -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu (for small screens) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400  hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::user()->role == 'dokter')
                <!-- Mobile menu link for Dokter Dashboard -->
                <x-responsive-nav-link :href="route('dokter.dashboard')" :active="request()->routeIs('dokter.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                {{-- Mobile menu link for "Obat" (Medicine) --}}
                <x-responsive-nav-link :href="route('dokter.obat.index')" :active="request()->routeIs('dokter.obat.index')">
                    {{ __('Obat') }}
                </x-responsive-nav-link>
            @elseif(Auth::user()->role == 'pasien')
                <!-- Mobile menu link for Pasien Dashboard -->
                <x-responsive-nav-link :href="route('pasien.dashboard')" :active="request()->routeIs('pasien.dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <!-- Display logged-in user's name and email -->
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Mobile profile link -->
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Mobile logout option -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
