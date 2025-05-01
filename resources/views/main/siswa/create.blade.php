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
                    <form action="{{ route('siswa.store') }}" method="POST" class="flex flex-col gap-4 mt-4">
                        @csrf

                        <x-input-form label="NIK" name="no_ktp" type="number"
                            placeholder="Masukkan Nomor Induk Kependudukan Anda" />
                        <x-input-form label="Tanggal Lahir" name="tanggal_lahir" placeholder="" type="date" />
                        <x-input-form inputType="option" name="jenis_kelamin" label="Gender"
                            default="Select Option" :options="[
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ]" />
                        <x-input-form inputType="option" name="agama" label="Agama"
                            default="Select Option" :options="[
                                'Hindu' => 'Hindu',
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Protestan' => 'Protestan',
                                'Konghucu' => 'Konghucu',
                            ]" />
                        <x-input-form inputType="option" name="golongan_darah" label="Golongan Darah"
                            default="Select Option" :options="[
                                'A' => 'Golongan Darah A',
                                'B' => 'Golongan Darah B',
                                'AB' => 'Golongan Darah AB',
                                'O' => 'Golongan Darah O',
                            ]" />
                        <x-input-form label="Alamat" name="alamat" placeholder="Masukkan alamat anda" />
                        <x-input-form label="Tinggi Badan" name="tinggi_badan" placeholder="Masukkan tinggi badan anda"
                            type="number" />
                        <x-input-form label="Berat Badan" name="berat_badan" placeholder="Masukkan berat badan anda"
                            type="number" />
                        <x-input-form label="Whatsapp" name="wa" placeholder="Masukkan no wa contoh (082xxxx)"
                            type="text" />
                        <x-input-form label="Instagram" name="instagram"
                            placeholder="Masukkan id instagram (ex : @wtcbali)" type="text" />
                        <x-button type="submit"></x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-main-layout>
