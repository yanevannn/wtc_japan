<x-main-layout>
    <x-slot:title>Jadwal Interview</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tambah Sesi Interview
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <x-form :action="route('sesi-interview.store')">
                        <x-form-input label="Pilih Perusahaan" name="perusahaan_id" inputType="option">
                        <x-form-option value='' disabled>Select Option</x-form-option>
                        @foreach ($data as $perusahaan)
                            <x-form-option value="{{ $perusahaan->id }}">{{ $perusahaan->nama_perusahaan }}</x-form-option>
                        @endforeach
                        </x-form-input>
                        <div class="grid md:grid-cols-2 gap-4">
                            <x-form-input label="Tanggal Interview" name="tanggal" inputType="date" />
                            <x-form-input label="Kuota" name="kuota" placeholder="Kuota Peserta" type="number"/>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <x-form-input label="Jam Mulai" name="jam_mulai" inputType="time"/>
                            </div>
                            <div>
                                <x-form-input label="Jam Selesai" name="jam_selesai" inputType="time"/>
                            </div>
                        </div>
                        <x-button type="submit"></x-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-main-layout>
