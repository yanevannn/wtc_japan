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
                <div class="text-gray-800 dark:text-white/90">
                    <h2>Instruksi Pembayaran :</h2>
                    <ul class="list-disc pl-5 text-base">
                        <li>Pembayaran dilakukan ke rekening <strong>[Nama Bank]</strong> a.n <strong>[Nama
                                Penerima]</strong> dengan nomor rekening <strong>[Nomor Rekening]</strong> dengan
                            Nominal <strong> Rp 200.000</strong>.</li>
                        <li>Bukti pembayaran diupload di bawah ini setelah melakukan pembayaran.</li>
                        <li>Pastikan untuk mengisi informasi pembayaran dengan benar dan lengkap.</li>
                        <li>Apabila dalam 2x24 Jam status verfikasi masih pending silahkan menghubungi admin melalui
                            Whastapp <strong> +628214443231 </strong></li>
                    </ul>
                </div>
                <div class="mt-10 border-t border-gray-300 dark:border-gray-100">
                    @if ($data == null)
                        <div class="dark:border-gray-800  text-center py-20 text-gray-800 dark:text-white/90">
                            <h2 class="text-lg font-bold">Belum Ada Transaksi</h2>
                            <p class="text-base mb-4">Anda belum melakukan pembayaran pendaftaran. Silakan melakukan
                                pembayaran.</p>
                            <a href="{{ route('pembayaranpendaftaran.create') }}">
                                <button
                                    class="items-center gap-2 px-2 py-2 text-sm font-medium text-white transition rounded-lg 
                                    bg-blue-500 shadow-theme-xs hover:bg-blue-700">Lakukan
                                    Pembayaran
                                </button>
                            </a>
                        </div>
                    @else
                        <div class="dark:border-gray-800 text-center py-20 text-gray-800 dark:text-white/90">
                            <h2 class="text-lg font-bold">Status Pembayaran</h2>
                            <p class="text-base mb-4">Pembayaran Anda telah diterima.</p>
                            <p class="text-base mb-4">Status <br>
                                @if ($data->status == 'pending')
                                    <x-badge type="warning">Menunggu verifikasi</x-badge>
                                @elseif($data->status == 'verified')
                                    <x-badge>Terverifikasi</x-badge>
                                @else
                                    <x-badge type="error">Rejected</x-badge>
                                @endif
                            </p>
                            <p class="text-base mb-4">Tanggal Pembayaran : <span
                                    class=" text-sm font-bold">{{ $data->tanggal_bayar }}</span></p>
                            <p class="text-base mb-4">Bukti Pembayaran</p>
                            <img src="{{ $data->url }}" alt="Bukti Pembayaran"
                                class="w-[400px] h-auto mt-2 border border-gray-300 rounded mx-auto mb-3">
                            @if ($data->status == "pending" || $data->status == "rejected")
                                <div class="mx-auto">
                                    <a href="{{ route('pembayaranpendaftaran.edit') }}">
                                        <button
                                            class="items-center gap-2 px-2 py-2 text-sm font-medium text-white transition rounded-lg 
                                            bg-orange-400 shadow-theme-xs hover:bg-orange-500">Upload
                                            Ulang Bukti Pembayaran
                                        </button>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
    </div>
</x-main-layout>
