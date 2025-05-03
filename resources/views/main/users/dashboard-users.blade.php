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
                <p class="text-gray-700 dark:text-gray-400 mt-2">Belum Memiliki Nomor Induk Siswa</p>
            </div>
        </div>

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
        <div class="mt-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Pengumuman</h2>
            <p class="text-sm text-gray-600 dark:text-white/70 mb-4"> Informasi terkini terkait WTC2JAPAN</p>
            <div class="flex flex-col gap-4">
                <x-announcement></x-announcement>
                <x-announcement></x-announcement>
                <x-announcement></x-announcement>
                <x-announcement></x-announcement>
            </div>

        </div>
    </div>
</x-main-layout>
