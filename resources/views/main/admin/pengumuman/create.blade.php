<x-main-layout>
    <x-slot:title>Pengumuman</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tambah Data Pengumuman
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <x-form :action="route('pengumuman.store')" hasFile="true">
                        <x-form-input label="Judul" name="judul" placeholder="Masukkan judul pengumuman" />
                        <x-form-input label="Deskripsi" name="deskripsi" placeholder="Deskripsi Pengumuman" />
                        <x-form-input label="File" name="file" inputType="file" />
                        <x-button type="submit"></x-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-main-layout>
