<x-main-layout>
    <x-slot:title>Perusahaan</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tambah Data Perusahaan
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <x-form :action="route('perusahaan.store')">
                        <x-form-input label="Nama Perusahaan" name="nama_perusahaan" placeholder="Masukkan nama perusahaan" />
                        <x-form-input label="Tipe Perusahaan" name="tipe" inputType="option">
                            <x-form-option value='' disabled>Select Option</x-form-option>
                            <x-form-option value="pertanian">Pertanian</x-form-option>
                            <x-form-option value="industri">Industri</x-form-option>
                            <x-form-option value="makanan">Makanan</x-form-option>
                        </x-form-input>
                        <x-form-input label="Alamat" name="alamat" placeholder="Masukkan alamat perusahaan" />
                        <x-form-input label="Deskripsi" name="deskripsi" placeholder="Deskripsi Pengumuman" inputType="textarea"/>
                        <x-button type="submit"></x-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-main-layout>
