<x-main-layout>
    <x-slot:title>
        Dokumen Siswa
    </x-slot:title>

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Input Dokumen Siswa
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div class="mb-4">
                    <h4 class="text-base font-medium text-gray-800 dark:text-white/90 -mt-2 mb-2">
                        Catatan:
                    </h4>
                    <ul class="list-disc list-inside text-gray-600 dark:text-gray-400 text-sm space-y-1 ml-3">
                        <li>Seluruh dokumen harus berformat <strong>PDF</strong>.</li>
                        <li>Ukuran masing-masing file maksimum <strong>1 MB</strong>.</li>
                        <li>Pastikan file dokumen jelas, terbaca, dan tidak buram untuk mempermudah verifikasi.</li>
                        <li>Untuk Dokumen <strong>Ijazah S1 & Paspor</strong> bersifat opsional (boleh dikosongkan).</li>
                    </ul>
                </div>

                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <x-form :action="route('form.dokumen.store')" hasFile="true">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-form-input label="KTP" name="ktp" inputType="file" />
                            <x-form-input label="Kartu Keluarga" name="kk" inputType="file" />
                            <x-form-input label="Akta Kelahiran" name="akta" inputType="file" />
                            <x-form-input label="Ijazah SD" name="ijazah_sd" inputType="file" />
                            <x-form-input label="Ijazah SMP" name="ijazah_smp" inputType="file" />
                            <x-form-input label="Ijazah SMA" name="ijazah_sma" inputType="file" />
                            <x-form-input label="Ijazah S1 (Opsional)" name="ijazah_s1" inputType="file" />
                            <x-form-input label="Paspor (Opsional)" name="paspor" inputType="file" />
                        </div>

                        <x-button type="submit"></x-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
