<x-main-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <div class="flex flex-col gap-4">
        <!-- Profile Card -->
        <div
            class="rounded-xl flex flex-col md:col-span-2 border border-gray-200 p-5 dark:border-gray-800 dark:bg-white/[0.03] text-white">
            <div class="bg-gradient-to-br bg-brand-600 w-full h-32 rounded-t-lg mb-12 relative shadow-xl">
                <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                    <div class="bg-blue-500 dark:bg-gray-900 rounded-full p-1">
                        <img src="{{ asset('src/images/user/profile.png') }}" alt="Avatar"
                            class="w-24 h-24 rounded-full border-4 border-white shadow-2xl">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <h2 class="text-xl font-semibold mt-5 text-gray-800 dark:text-white/90">WAYAN EVAN ADA MUNAYANA</h2>
                <p class="text-gray-700 dark:text-gray-400 mt-2">Program Magang Jepang 🇯🇵 </p>
                <p class="text-gray-700 dark:text-gray-400 mt-2">Status Pendafataran <br>
                    <span
                        class="text-gray-700 dark:text-gray-200 font-semibold">{{ auth()->user()->siswa->statusPendaftaran->status }}</span>
                </p>
            </div>
        </div>

        @if (auth()->user()->siswa && auth()->user()->siswa->no_ktp === null)
            <!-- Info Card -->
            <div
                class="md:col-span-3 bg-brand-600 text-white rounded-xl shadow p-6 flex flex-col justify-center items-center h-[200px]">
                <p class="sm:col-span-2 text-center text-white font-medium ">
                    Untuk melanjutkan pendaftaran silahka isi data pribadi terlebih dahulu.
                </p>
                <button
                    class="items-center gap-2 px-2 py-2 text-sm font-medium text-white uppercase transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600 mt-4">
                    <a href="{{ route('form.personal.index') }}">Klik untuk mengisi Data Diri</a>
                </button>
            </div>
            {{-- null dipakai karena hasOne / belongsTo --}}
        @elseif(auth()->user()->siswa && auth()->user()->siswa->orangTua === null)
            <!-- Info isi data orang tua -->
            <div
                class="md:col-span-3 bg-brand-600 text-white rounded-xl shadow p-6 flex flex-col justify-center items-center h-[200px]">
                <p class="sm:col-span-2 text-center text-white font-medium ">
                    Data pribadi sudah lengkap. Silahkan lengkapi data orang tua Anda.
                </p>
                <a href="{{ route('form.orang-tua.create') }}">
                    <button
                        class="items-center gap-2 px-4 py-2 text-sm font-medium text-white uppercase transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600 mt-4">
                        Klik untuk mengisi Data Orang Tua
                    </button>
                </a>
            </div>
            {{-- null dipakai karena hasMany / belongsToMany (collection) --}}
        @elseif(auth()->user()->siswa && auth()->user()->siswa->dokumen->isEmpty())
            <!-- Info isi data orang tua -->
            <div
                class="md:col-span-3 bg-brand-600 text-white rounded-xl shadow p-6 flex flex-col justify-center items-center h-[200px]">
                <p class="sm:col-span-2 text-center text-white font-medium ">
                    Data pribadi & Orang Tua sudah lengkap. Selanjutnya lengkapi data dokumen Anda.
                </p>
                <a href="{{ route('form.dokumen.create') }}">
                    <button
                        class="items-center gap-2 px-4 py-2 text-sm font-medium text-white uppercase transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600 mt-4">
                        Klik untuk mengisi Data Dokumen
                    </button>
                </a>
            </div>
        @elseif(auth()->user()->siswa && auth()->user()->siswa->pembayaran->isEmpty())
            <!-- Info isi data orang tua -->
            <div
                class="md:col-span-3 bg-brand-600 text-white rounded-xl shadow p-6 flex flex-col justify-center items-center h-[200px]">
                <p class="sm:col-span-2 text-center text-white font-medium ">
                    Seluruh data pribadi, Orang Tua, dan Dokumen telah lengkap. Silakan melanjutkan ke tahap pembayaran
                    pendaftaran.
                </p>
                <a href="{{ route('pembayaran-pendaftaran') }}">
                    <button
                        class="items-center gap-2 px-4 py-2 text-sm font-medium text-white uppercase transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600 mt-4">
                        Klik untuk Melakukan Pembayaran
                    </button>
                </a>
            </div>
        @elseif(auth()->user()->siswa && auth()->user()->siswa->statusPendaftaran->status === 'Menunggu Verifikasi')
            <!-- Info isi data orang tua (Versi Lebih Menarik) -->
            <div
                class="md:col-span-3 bg-yellow-500 dark:bg-yellow-400/80 text-white rounded-2xl shadow-lg p-8 flex flex-col justify-center items-center h-[220px] transition-all duration-300 hover:bg-yellow-500/90 dark:hover:bg-yellow-400/90">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mb-4 text-white drop-shadow" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2l4-4m7 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl font-semibold mb-2">Data Sudah Lengkap</h3>
                <p class="text-center text-sm sm:text-base max-w-md">
                    Menunggu verifikasi dari Admin. Silakan cek secara berkala untuk melihat status pendaftaran Anda.
                </p>
            </div>
        @endif
        <div class="mt-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Pengumuman</h2>
            <p class="text-sm text-gray-600 dark:text-white/70 mb-4"> Informasi terkini terkait WTC2JAPAN</p>
            <div class="flex flex-col gap-4">
                @foreach ($announcements as $information)
                    <x-announcement :title="$information->judul" :description="$information->deskripsi"
                        file="{{ asset('storage/pengumuman_files/' . $information->file) }}"
                        date="{{ $information->created_at->diffForHumans() }}" />
                @endforeach
            </div>

        </div>
    </div>
</x-main-layout>
