<x-main-layout>
    <x-slot:title>Pembayaran Pendaftaran</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Pembayaran Pendaftaran
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div class="w-full max-w-lg p-6 mx-auto">
                    <ol class="relative border-l border-gray-300">

                        <!-- Step 1 - Done -->
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-brand-500 rounded-full ring-8 ring-white">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <h3 class="text-lg font-semibold text-black">Register Akun</h3>
                            <p class="text-sm text-gray-500">Siswa membuat akun awal untuk mengakses sistem pendaftaran.
                            </p>
                        </li>

                        <!-- Step 2 - Done -->
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-brand-500 rounded-full ring-8 ring-white">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <h3 class="text-lg font-semibold text-black">Melengkapi Data Diri</h3>
                            <p class="text-sm text-gray-500">Melengkapi data pribadi, orang tua, dan dokumen yang
                                dibutuhkan.</p>
                        </li>

                        <!-- Step 3 - Current -->
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-white border-2 border-brand-500 rounded-full">
                                <span class="w-2.5 h-2.5 bg-brand-500 rounded-full"></span>
                            </span>
                            <h3 class="text-lg font-semibold text-brand-600">Pembayaran Seleksi</h3>
                            <p class="text-sm text-gray-500">Melakukan pembayaran biaya seleksi untuk proses berikutnya.
                            </p>
                        </li>

                        <!-- Step 4 - Upcoming -->
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-white border-2 border-gray-300 rounded-full"></span>
                            <h3 class="text-lg font-semibold text-gray-400">Seleksi Pendaftaran</h3>
                            <p class="text-sm text-gray-400">Proses seleksi administrasi atau tes awal kelayakan.</p>
                        </li>

                        <!-- Step 5 - Upcoming -->
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-white border-2 border-gray-300 rounded-full"></span>
                            <h3 class="text-lg font-semibold text-gray-400">Pembayaran Pelatihan</h3>
                            <p class="text-sm text-gray-400">Melakukan pembayaran untuk pelatihan setelah seleksi.</p>
                        </li>

                        <!-- Step 6 - Upcoming -->
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-white border-2 border-gray-300 rounded-full"></span>
                            <h3 class="text-lg font-semibold text-gray-400">Pelatihan</h3>
                            <p class="text-sm text-gray-400">Mengikuti pelatihan yang disediakan lembaga.</p>
                        </li>

                        <!-- Step 7 - Upcoming -->
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-white border-2 border-gray-300 rounded-full"></span>
                            <h3 class="text-lg font-semibold text-gray-400">Mendaftar Interview</h3>
                            <p class="text-sm text-gray-400">Mengisi jadwal untuk mengikuti sesi interview akhir.</p>
                        </li>

                        <!-- Step 8 - Upcoming -->
                        <li class="mb-10 ml-6">
                            <span
                                class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-white border-2 border-gray-300 rounded-full"></span>
                            <h3 class="text-lg font-semibold text-gray-400">Interview</h3>
                            <p class="text-sm text-gray-400">Menjalani sesi wawancara sebagai bagian dari penilaian
                                akhir.</p>
                        </li>

                        <!-- Step 9 - Upcoming -->
                        <li class="ml-6">
                            <span
                                class="absolute -left-3 flex items-center justify-center w-6 h-6 bg-white border-2 border-gray-300 rounded-full"></span>
                            <h3 class="text-lg font-semibold text-gray-400">Selesai</h3>
                            <p class="text-sm text-gray-400">Seluruh proses pendaftaran dan pelatihan telah selesai.</p>
                        </li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
