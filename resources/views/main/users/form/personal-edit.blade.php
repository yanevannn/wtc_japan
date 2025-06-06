<x-main-layout>
    <x-slot:title>Infromasi Siswa</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Input Data Diri
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">

                <div
                    class="overflow-hiden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">

                    <x-form :action="route('form.personal.update', $data->id)" method="put">
                        <x-form-input label="Nama Depan" name="fname" placeholder="Masukkan nama depan anda" value="{{ $data->user->fname }}" />
                        <x-form-input label="Nama Belakang" name="lname" placeholder="Masukkan nama depan anda" value="{{ $data->user->lname }}" />
                        <x-form-input label="NIK" name="no_ktp" type="number"
                            placeholder="Masukkan Nomor Induk Kependudukan Anda" value="{{ $data->no_ktp }}" />
                        <x-form-input label="Tanggal Lahir" name="tanggal_lahir" inputType="date"
                            value="{{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('Y-m-d') }}" />

                        <x-form-input label="Gender" name="jenis_kelamin" inputType="option">
                            <x-form-option value='' disabled>Select Option</x-form-option>
                            <x-form-option value="Laki-laki" :selected="$data->jenis_kelamin">Laki-laki</x-form-option>
                            <x-form-option value="Perempuan" :selected="$data->jenis_kelamin">Perempuan</x-form-option>
                        </x-form-input>

                        <x-form-input label="Agama" name="agama" inputType="option">
                            <x-form-option value='' disabled>Select Option</x-form-option>
                            <x-form-option value="Hindu" :selected="$data->agama">Hindu</x-form-option>
                            <x-form-option value="Islam" :selected="$data->agama">Islam</x-form-option>
                            <x-form-option value="Kristen" :selected="$data->agama">Kristen</x-form-option>
                            <x-form-option value="Protestan" :selected="$data->agama">Protestan</x-form-option>
                            <x-form-option value="Konghucu" :selected="$data->agama">Konghucu</x-form-option>
                        </x-form-input>

                        <x-form-input label="Golongan Darah" name="golongan_darah" inputType="option">
                            <x-form-option value='' disabled>Select Option</x-form-option>
                            <x-form-option value="A" :selected="$data->golongan_darah">Golongan Darah A</x-form-option>
                            <x-form-option value="B" :selected="$data->golongan_darah">Golongan Darah B</x-form-option>
                            <x-form-option value="AB" :selected="$data->golongan_darah">Golongan Darah AB</x-form-option>
                            <x-form-option value="O" :selected="$data->golongan_darah">Golongan Darah O</x-form-option>
                        </x-form-input>

                        <x-form-input label="Alamat" name="alamat" placeholder="Masukkan alamat anda"
                            value="{{ $data->alamat }}" />
                        <x-form-input label="Tinggi Badan" name="tinggi_badan" placeholder="Masukkan tinggi badan anda"
                            type="number" value="{{ $data->tinggi_badan }}" />
                        <x-form-input label="Berat Badan" name="berat_badan" placeholder="Masukkan berat badan anda"
                            type="number" value="{{ $data->tinggi_badan }}" />
                        <x-form-input label="Whatsapp" name="wa" inputType="phone" value="{{ $data->wa }}" />
                        <x-form-input label="Instagram" name="instagram"
                            placeholder="Masukkan id instagram (ex : @wtcbali)" type="text"
                            value="{{ $data->instagram }}" />

                        <x-button type="submit"></x-button>
                    </x-form>

                </div>
            </div>
        </div>
    </div>
</x-main-layout>
