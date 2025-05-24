<x-main-layout>
    <x-slot:title>Jadwal Interview</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Edit Sesi Interview
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <x-form :action="route('sesi-interview.update', $data->id)" method="put">
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <x-form-input label="Pilih Perusahaan" name="perusahaan_id" inputType="option">
                                    <x-form-option value='' disabled>Select Option</x-form-option>
                                    @foreach ($perusahaan as $company)
                                        <x-form-option
                                            value="{{ $company->id }}" :selected="$data->perusahaan_id">{{ $company->nama_perusahaan }}</x-form-option>
                                    @endforeach
                                </x-form-input>
                            </div>
                            <div>
                                <x-form-input label="Tempat Interview" name="tempat" placeholder="Masukkan tempat pelaksanaan" value="{{ $data->tempat }}"/>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4">
                            <x-form-input label="Tanggal Interview" name="tanggal" inputType="date" value="{{ $data->tanggal }}"/>
                            <x-form-input label="Kuota" name="kuota" placeholder="Kuota Peserta" type="number" value="{{ $data->kuota }}"/>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <x-form-input label="Jam Mulai" name="jam_mulai" inputType="time" value="{{ \Carbon\Carbon::parse($data->jam_mulai)->format('H:i') }}"/>
                            </div>
                            <div>
                                <x-form-input label="Jam Selesai" name="jam_selesai" inputType="time" value="{{ \Carbon\Carbon::parse($data->jam_selesai)->format('H:i') }}"/>
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

