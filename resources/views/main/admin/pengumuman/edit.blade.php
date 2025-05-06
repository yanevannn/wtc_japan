<x-main-layout>
    <x-slot:title>Administrator</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Edit Data Administrator
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">

                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <x-form :action="route('pengumuman.update', $data->id)" method="PUT" hasFile="true">
                        <x-form-input label="Judul" name="judul" placeholder="Masukkan judul pengumuman"
                            value="{{ $data->judul }}" />
                        <x-form-input label="Deskripsi" name="deskripsi" placeholder="Deskripsi Pengumuman"
                            value="{{ $data->deskripsi }}" />
                        <x-form-input label="Status" name="is_published" inputType="option">
                            <x-form-option value='' disabled>Select Option</x-form-option>
                            <x-form-option value="0" :selected="$data->is_published">Unpublish</x-form-option>
                            <x-form-option value="1" :selected="$data->is_published">Publish</x-form-option>
                        </x-form-input>
                        <x-form-input label="File" name="file" inputType="file" />
                        <a href="{{ asset('storage/pengumuman_files/' . $data->file) }}"
                            class="text-sm font-medium text-gray-700 dark:text-gray-400 ml-1">File Sebelumnya <span
                                class="text-md ml-1 text-blue-600 underline underline-offset-2 hover:text-blue-800 ">{{ $data->file }}</span></a>
                        <x-button type="save"></x-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
