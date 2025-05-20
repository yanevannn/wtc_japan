<x-main-layout>
    <x-slot:title>Verifikasi Pembayaran Pelatihan</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Pembayaran Pelatihan
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <!-- Tampilkan detail pembayaran -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90 text-center mb-2">
                            Bukti Pembayaran Pelatihan
                        </h3>
                        <img src="{{ asset('storage/' . $data->bukti_pembayaran) }}" alt="" class="">
                    </div>
                    <div>
                        <div class="text-md font-medium text-gray-800 dark:text-white/90 text-center mb-2">
                            <h3 class="mb-3">Detail Pembayaran</h3>
                            <div>
                                <ul class="max-w-md mx-auto space-y-2 text-sm text-gray-700 dark:text-gray-300">
                                    <li class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                        <span class="font-medium">Nama Pendaftar:</span>
                                        <span>{{ $data->siswa->user->fname . ' ' . $data->siswa->user->lname }}</span>
                                    </li>
                                    <li class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                        <span class="font-medium">Gelombang Pendaftaran:</span>
                                        <span>{{ $data->siswa->angkatan->nomor_angkatan }}</span>
                                    </li>
                                    <li class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                        <span class="font-medium">Tanggal Pembayaran:</span>
                                        <span>{{ \Carbon\Carbon::parse($data->tanggal_bayar)->format('d M Y') }}</span>
                                    </li>
                                    <li class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-2">
                                        <span class="font-medium">Status Pembayaran:</span>
                                        <span class="capitalize">{{ $data->status }} (Menunggu verifikasi)</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-8 flex justify-center space-x-4">
                            <!-- Tombol Verifikasi dan Tolak -->
                            <form action="{{ route('verifikasi.pembayaran-pelatihan.update', $data->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="status" value="verified"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Verifikasi
                                </button>
                            </form>

                            <form action="{{ route('verifikasi.pembayaran-pelatihan.update', $data->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="status" value="rejected"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</x-main-layout>
