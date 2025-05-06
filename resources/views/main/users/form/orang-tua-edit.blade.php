<x-main-layout>
    <x-slot:title>
        Informasi Orang Tua Siswa
    </x-slot:title>

    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Input Data Orang Tua
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-3 mt-1">
                    <x-form :action="route('form.orang-tua.update', $data->id)" method="put">
                        <x-form-input label="Nama Ayah" name="nama_ayah" placeholder="Masukkan nama ayah anda"  value="{{ $data->nama_ayah }}"/>
                        <x-form-input label="Alamat Ayah" name="alamat_ayah" placeholder="Masukkan alamat ayah anda" value="{{ $data->alamat_ayah }}"/>
                        <x-form-input label="Nomor Telepon Ayah" name="no_telp_ayah" placeholder="Masukkan nomor telepon contoh (082xxxx)" value="{{ $data->no_telp_ayah }}"/>
                        <x-form-input label="Pekerjaan Ayah" name="pekerjaan_ayah" placeholder="Masukkan pekerjaan ayah anda" value="{{ $data->pekerjaan_ayah }}"/>
                        <x-form-input label="Nama ibu" name="nama_ibu" placeholder="Masukkan nama ayah anda"  value="{{ $data->nama_ibu }}"/>
                        <x-form-input label="Alamat ibu" name="alamat_ibu" placeholder="Masukkan alamat ayah anda" value="{{ $data->alamat_ibu }}"/>
                        <x-form-input label="Nomor Telepon ibu" name="no_telp_ibu" placeholder="Masukkan nomor telepon contoh (082xxxx)" value="{{ $data->no_telp_ibu }}"/>
                        <x-form-input label="Pekerjaan ibu" name="pekerjaan_ibu" placeholder="Masukkan pekerjaan ayah anda" value="{{ $data->pekerjaan_ibu }}"/>
                        <x-button type="submit">Submit</x-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
