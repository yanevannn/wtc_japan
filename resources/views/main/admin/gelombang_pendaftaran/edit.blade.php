<x-main-layout>
    <x-slot:title>Gelombang Pendaftaran</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Edit Gelombang Pendaftaran
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">

                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <x-form action="{{ route('gelombang.update', $data->id) }}" method="PUT">
                        @csrf
                        <x-form-input label="Nama gelombang pendafatraan" name="nama_gelombang"
                            placeholder="Masukkan nama gelombang" value="{{ $data->nama_gelombang }}" />
                        <x-form-input label="Tahun" name="tahun" inputType="year"
                            placeholder="Masukkan tahun untuk golmbang ini" value="{{ $data->tahun }}" />
                        <x-form-input label="Status" name="status" inputType="option">
                            <x-form-option value='' disabled>Select Option</x-form-option>
                            <x-form-option value="open" name="status" :selected="$data->status">OPEN</x-form-option>
                            <x-form-option value="closed" name="status" :selected="$data->status">CLOSE</x-form-option>
                        </x-form-input>
                        <x-button type="save"></x-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-main-layout>
