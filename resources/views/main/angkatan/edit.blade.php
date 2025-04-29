<x-main-layout>
    <x-slot:title>Angkatan</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Perbarui Angkatan
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">

                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <form action="{{ route('angkatan.update', $data->id) }}" method="POST"
                        class="flex flex-col gap-4 mt-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Angkatan
                            </label>
                            <input type="text" placeholder="Masukkan Angkatan" name="angkatan"
                                value="{{ old('angkatan', $data->angkatan) }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            @error('angkatan')
                                <x-alert-validation message="{{ $message }}"/>
                            @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Tahun
                            </label>
                            <input type="number" placeholder="masukkan tahun" name="tahun"
                                value="{{ old('tahun', $data->tahun) }}"
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                            @error('tahun')
                                <x-alert-validation message="{{ $message }}"/>
                            @enderror
                        </div>
                        <x-button type="save"></x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-main-layout>
