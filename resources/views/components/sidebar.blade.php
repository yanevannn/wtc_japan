<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0">
    <!-- SIDEBAR HEADER -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center gap-2 pt-8 sidebar-header pb-7">
        <a href="{{ route('dashboard') }}">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                {{-- <img class="dark:hidden h-[32px]" src="{{ asset('src/images/logo/logo-icon.png') }}" alt="Logo"/> --}}
                <h1 class="text-2xl font-bold dark:hidden ">WTC <span style="color:#d3e227">2</span> JAPAN</h1>
                {{-- <img class="hidden dark:block" src="src/images/logo/logo-dark.svg" alt="Logo" /> --}}
                <h1 class="text-2xl font-bold hidden dark:block text-white">WTC <span style="color:#d3e227">2</span> JAPAN
                </h1>
            </span>
            {{-- <img class="logo-icon" :class="sidebarToggle ? 'lg:block' : 'hidden'" src="src/images/logo/logo-icon.png" alt="Logo" /> --}}
            <h1 class="logo-icon text-2xl font-bold dark:text-white" :class="sidebarToggle ? 'lg:block' : 'hidden'">
                W<span style="color:#d3e227">T</span>C</h1>
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <!-- Sidebar Menu -->
        <nav x-data="{ selected: $persist('Dashboard') }">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        MENU
                    </span>
                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="mx-auto fill-current menu-group-icon" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill="" />
                    </svg>
                </h3>
                <ul class="flex flex-col gap-4 mb-6">

                    @if (auth()->user()->role == 'admin')
                        <x-menu-item href="{{ route('dashboard') }}" label="Dashboard" :icon="file_get_contents(public_path('assets/dashboard.svg'))"
                            activePath="dashboard*" />
                        <x-menu-item href="{{ route('angkatan.index') }}" label="Angkatan" :icon="file_get_contents(public_path('assets/angkatan.svg'))"
                            activePath="angkatan*" />
                        <x-menu-item href="{{ route('admin.index') }}" label="Admin User" :icon="file_get_contents(public_path('assets/admin.svg'))"
                            activePath="admin*" />
                        <x-menu-item href="{{ route('pengumuman.index') }}" label="Pengumuman" :icon="file_get_contents(public_path('assets/announcement.svg'))"
                            activePath="pengumuman*" />

                        <x-sidebar-dropdown label="Verifikasi" menuKey="verfikasi" :icon="file_get_contents(public_path('assets/verfikasi.svg'))" :activePaths="['verifikasi/dokumen*', 'verifikasi/pembayaran-pendaftaran*', 'verifikasi/pembayaran-pelatihan*']">
                            <x-menu-item href="{{ route('verifikasi.dokumen.index') }}" label="Dokumen"
                                activePath="verifikasi/dokumen*" />
                            <x-menu-item href="{{ route('verifikasi.pembayaran-pendaftaran.index') }}" label="Pembayaran Pendaftaran"
                                activePath="verifikasi/pembayaran-pendaftaran*" />
                            <x-menu-item href="{{ route('verifikasi.pembayaran-pelatihan.index') }}" label="Pembayaran Pelatihan" activePath="verifikasi/pembayaran-pelatihan*" />
                        </x-sidebar-dropdown>

                        <x-sidebar-dropdown label="Status" menuKey="status" :icon="file_get_contents(public_path('assets/status.svg'))" :activePaths="['status-pendaftaran*', 'status-siswa*']">
                            <x-menu-item href="{{ route('status-pendaftaran.index') }}" label="Status Pendaftaran"
                                activePath="status-pendaftaran*" />
                            <x-menu-item href="{{ route('status-siswa.index') }}" label="Status Siswa"
                                activePath="status-siswa*" />
                        </x-sidebar-dropdown>
                    @else
                        <x-menu-item href="{{ route('dashboard') }}" label="Dashboard" :icon="file_get_contents(public_path('assets/dashboard.svg'))"
                            activePath="dashboard*" />
                        <x-menu-item href="{{ route('dokumen.index') }}" label="Dokumen Pendaftaran" :icon="file_get_contents(public_path('assets/dokumen-stack.svg'))"
                            activePath="" />
                        <x-sidebar-dropdown label="Pembayaran" menuKey="pembayran" :icon="file_get_contents(public_path('assets/pembayaran.svg'))" :activePaths="['pembayaran/*']">
                            <x-menu-item href="{{ route('pembayaranpendaftaran') }}" label="Pendaftaran" activePath="pembayaran/pendaftaran*" />
                            <x-menu-item href="{{ route('pembayaranpelatihan.index') }}" label="Pelatihan" activePath="pembayaran/pelatihan*" />
                        </x-sidebar-dropdown>
                        <x-sidebar-dropdown label="Nilai" menuKey="nilai" :icon="file_get_contents(public_path('assets/nilai.svg'))" :activePaths="['nilai/seleksi*', 'nilai/pelatihan*']">
                            <x-menu-item href="{{ route('nilaiseleksi.index') }}" label="Nilai Seleksi" activePath="nilai/seleksi*" />
                            <x-menu-item href="{{ route('nilaipelatihan.index') }}" label="Nilai Pelatihan" activePath="nilai/pelatihan*" />
                            <x-menu-item href="" label="Hasil Interview" activePath="" />
                        </x-sidebar-dropdown>
                    @endif
                </ul>
            </div>
        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>
