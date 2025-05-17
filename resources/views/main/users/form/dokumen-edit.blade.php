<x-main-layout>
    <x-slot:title>
        Dokumen Pendaftaran 
    </x-slot:title>

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Edit Dokumen {{\App\Models\Dokumen::getJenisDokumenHumanReadable($data->jenis_dokumen) }}
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
                        <li>Ukuran file dokumen {{ \App\Models\Dokumen::getJenisDokumenHumanReadable($data->jenis_dokumen) }} maksimum <strong>1 MB</strong>.</li>
                        <li>Pastikan file dokumen jelas, terbaca, dan tidak buram untuk mempermudah verifikasi.</li>
                    </ul>
                </div>

                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <x-form :action="route('form.dokumen.update', $data->id)" hasFile="true" method="put">
                        <x-form-input
                            label="{{ \App\Models\Dokumen::getJenisDokumenHumanReadable($data->jenis_dokumen) }}"
                            name="{{ $data->jenis_dokumen }}" inputType="file" />
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Dokumen {{ \App\Models\Dokumen::getJenisDokumenHumanReadable($data->jenis_dokumen) }} saat
                            ini:
                            <a href="{{ asset('storage/' . $data->file_path) }}" target="_blank"
                                class="text-blue-600 hover:underline">
                                Lihat Dokumen (PDF)
                            </a>
                        </div>

                        <x-button type="submit"></x-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
