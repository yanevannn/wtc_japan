<x-main-layout>
    <x-slot:title>
        Informasi Siswa
    </x-slot:title>

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Input Data Diri
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <x-form :action="route('form.personal.store')" method="put">
                        <x-form-input label="NIK" name="no_ktp" type="number"
                            placeholder="Masukkan Nomor Induk Kependudukan Anda" />
                        <x-form-input label="Tanggal Lahir" name="tanggal_lahir" inputType="date" />

                        <x-form-input label="Gender" name="jenis_kelamin" inputType="option">
                            <x-form-option value='' disabled>Select Option</x-form-option>
                            <x-form-option value="Laki-laki" name="gender">Laki-laki</x-form-option>
                            <x-form-option value="Perempuan" name="gender">Perempuan</x-form-option>
                        </x-form-input>

                        <x-form-input label="Agama" name="agama" inputType="option">
                            <x-form-option value='' disabled>Select Option</x-form-option>
                            <x-form-option value="Hindu" name="agama">Hindu</x-form-option>
                            <x-form-option value="Islam" name="agama">Islam</x-form-option>
                            <x-form-option value="Kristen" name="agama">Kristen</x-form-option>
                            <x-form-option value="Protestan" name="agama">Protestan</x-form-option>
                            <x-form-option value="Konghucu" name="agama">Konghucu</x-form-option>
                        </x-form-input>

                        <x-form-input label="Golongan Darah" name="golongan_darah" inputType="option">
                            <x-form-option value='' disabled>Select Option</x-form-option>
                            <x-form-option value="A" name="golongan_darah">Golongan Darah A</x-form-option>
                            <x-form-option value="B" name="golongan_darah">Golongan Darah B</x-form-option>
                            <x-form-option value="AB" name="golongan_darah">Golongan Darah AB</x-form-option>
                            <x-form-option value="O" name="golongan_darah">Golongan Darah O</x-form-option>
                        </x-form-input>

                        <x-form-input label="Alamat" name="alamat" placeholder="Masukkan alamat anda" />
                        <x-form-input label="Tinggi Badan" name="tinggi_badan" placeholder="Masukkan tinggi badan anda"
                            type="number" />
                        <x-form-input label="Berat Badan" name="berat_badan" placeholder="Masukkan berat badan anda"
                            type="number" />
                        <x-form-input label="Whatsapp" name="wa" placeholder="Masukkan no wa contoh (082xxxx)"
                            type="text" />
                        <x-form-input label="Instagram" name="instagram"
                            placeholder="Masukkan id instagram (ex : @wtcbali)" type="text" />

                        <x-button type="submit">Submit</x-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
