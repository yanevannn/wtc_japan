<x-main-layout>
    <x-slot:title>Verifikasi Dokumen</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Verifikasi Dokumen {{ ucwords(strtolower($siswa->user->fname . ' ' . $siswa->user->lname)) }}
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">

                <div class="overflow-x-auto">
                    <x-table>
                        <thead>

                            <tr class="text-gray-500 text-theme-xs dark:text-gray-400 text-center font-medium">
                                <th class="w-full md:w-[90%] py-3">Preview Dokumen</th>
                                <th class="hidden md:block py-3">Status</th>
                            </tr>
                        </thead>
                        <form action="{{ route('verifikasi.dokumen.update', $siswa->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <x-table-body>
                                @foreach ($data as $dokumen)
                                    <tr>
                                        <!-- Preview Dokumen -->
                                        <td class="px-5 py-4 sm:px-6 w-[600px]">
                                            <p class="text-gray-800 dark:text-white/90">
                                                Dokumen
                                                {{ \App\Models\Dokumen::getJenisDokumenHumanReadable($dokumen->jenis_dokumen) }}
                                            </p>
                                            <iframe src="{{ asset('storage/' . $dokumen->file_path) }}"
                                                class="w-full h-[500px]" type="application/pdf"></iframe>
                                        </td>
                                        <x-table-cell class="justify-center hidden md:block">
                                            <div class="flex flex-col gap-2 text-gray-800 dark:text-white/90">
                                                <label class="flex items-center space-x-2">
                                                    <input type="radio" name="{{ $dokumen->jenis_dokumen }}"
                                                        value="pending"
                                                        class="w-4 h-4 text-yellow-500 border-0 focus:outline-none focus:border-0"
                                                        {{ $dokumen->status == 'pending' ? 'checked' : '' }} disabled>
                                                    <span class="text-sm">Menunggu Verifikasi</span>
                                                </label>
                                                <label class="flex items-center space-x-2">
                                                    <input type="radio" name="{{ $dokumen->jenis_dokumen }}"
                                                        value="verified" class="w-4 h-4 text-green-500"
                                                        {{ $dokumen->status == 'verified' ? 'checked' : '' }}>
                                                    <span class="text-sm">Verifikasi</span>
                                                </label>
                                                <label class="flex items-center space-x-2">
                                                    <input type="radio" name="{{ $dokumen->jenis_dokumen }}"
                                                        value="rejected" class="w-4 h-4 text-red-500"
                                                        {{ $dokumen->status == 'rejected' ? 'checked' : '' }}>
                                                    <span class="text-sm">Tolak</span>
                                                </label>
                                            </div>
                                        </x-table-cell>
                                    </tr>
                                @endforeach
                            </x-table-body>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="px-4 py-2">
                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                                            <!-- Checkbox Aksi Semua -->
                                            <div class="flex items-center space-x-6">
                                                <label class="flex items-center space-x-2">
                                                    <input type="checkbox" id="checkVerifikasiAll"
                                                        class="w-4 h-4 text-green-500">
                                                    <span class="text-sm text-gray-800 dark:text-white/90">Verifikasi
                                                        Semua</span>
                                                </label>
                                                <label class="flex items-center space-x-2">
                                                    <input type="checkbox" id="checkRejectedAll"
                                                        class="w-4 h-4 text-red-500">
                                                    <span class="text-sm text-gray-800 dark:text-white/90">Tolak
                                                        Semua</span>
                                                </label>
                                            </div>

                                            <!-- Tombol Simpan -->
                                            <div class="text-right">
                                                <x-button id="submitButton" type="submit">Simpan</x-button>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </form>
                    </x-table>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script>
        // Fungsi untuk memeriksa status dokumen dan mengaktifkan/menonaktifkan tombol submit
        function checkPendingStatus() {
            // Cari semua input radio dengan status
            const radioButtons = document.querySelectorAll('input[type="radio"]');
            let isPending = false;

            // Periksa apakah ada radio button yang statusnya "pending"
            radioButtons.forEach(function(button) {
                if (button.value === "pending" && button.checked) {
                    isPending = true;
                }
            });

            // Aktifkan tombol submit hanya jika tidak ada status "pending"
            const submitButton = document.getElementById('submitButton');
            if (isPending) {
                submitButton.disabled = true;
            } else {
                submitButton.disabled = false;
            }
        }

        const checkVerifikasiAll = document.getElementById('checkVerifikasiAll');
        const checkRejectedAll = document.getElementById('checkRejectedAll');

        checkVerifikasiAll.addEventListener('change', function() {
            if (this.checked) {
                checkRejectedAll.checked = false; // uncheck yang lain
                const radios = document.querySelectorAll('input[type="radio"][value="verified"]');
                radios.forEach(r => r.checked = true);
            }
        });

        checkRejectedAll.addEventListener('change', function() {
            if (this.checked) {
                checkVerifikasiAll.checked = false; // uncheck yang lain
                const radios = document.querySelectorAll('input[type="radio"][value="rejected"]');
                radios.forEach(r => r.checked = true);
            }
        });
    </script>
</x-main-layout>
