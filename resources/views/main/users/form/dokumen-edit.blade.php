<x-main-layout>
    <x-slot:title>
        Dokumen Pendaftaran
    </x-slot:title>

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Edit Dokumen {{ \App\Models\Dokumen::getJenisDokumenHumanReadable($data->jenis_dokumen) }}
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div class="mb-4">
                    <h4 class="text-base font-medium text-gray-800 dark:text-white/90 -mt-2 mb-2">
                        Catatan:
                    </h4>
                    <ul class="list-disc list-inside text-gray-600 dark:text-gray-400 text-sm space-y-1 ml-3">
                        <li>Dokumen {{ \App\Models\Dokumen::getJenisDokumenHumanReadable($data->jenis_dokumen) }} harus
                            berformat <strong>PDF</strong>.</li>
                        <li>Ukuran file dokumen
                            {{ \App\Models\Dokumen::getJenisDokumenHumanReadable($data->jenis_dokumen) }} maksimum
                            <strong>1 MB</strong>.</li>
                        <li>Pastikan file dokumen jelas, terbaca, dan tidak buram untuk mempermudah verifikasi.</li>
                    </ul>
                </div>

                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <form method="POST" action="{{ route('form.dokumen.update', $data->id) }}"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <x-form-input
                            label="{{ \App\Models\Dokumen::getJenisDokumenHumanReadable($data->jenis_dokumen) }}"
                            name="{{ $data->jenis_dokumen }}" inputType="file" />
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Dokumen {{ \App\Models\Dokumen::getJenisDokumenHumanReadable($data->jenis_dokumen) }} saat
                            ini:
                            <a href="{{ $data->url }}" target="_blank" class="text-blue-600 hover:underline">
                                Lihat Dokumen (PDF)
                            </a>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit" id="btn-submit"
                                class="items-center gap-2 px-2 py-2 text-sm font-medium text-white transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600">Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('btn-submit');
            const form = document.querySelector('form');

            if (form && btn) {
                form.addEventListener('submit', function() {
                    btn.disabled = true;
                    btn.innerText = 'Sedang menyimpan...';
                });
            }
        });
    </script>
</x-main-layout>
