<x-main-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-dashboard-card title="Jumlah Gelombang" value="{{ $data['jumlah_gelombang'] }}" :icon="file_get_contents(public_path('assets/verfikasi.svg'))" />
        <x-dashboard-card title="Jumlah Pendaftar Gelombang terbaru" value="{{ $data['jumlah_pendaftar_terbaru'] }}" :icon="file_get_contents(public_path('assets/verfikasi.svg'))" />
        <x-dashboard-card title="Jumlah Angkatan" value="{{ $data['jumlah_angkatan'] }}" :icon="file_get_contents(public_path('assets/verfikasi.svg'))" />
        <x-dashboard-card title="Verifikasi Dokumen" value="{{ $data['verif_dokumen'] }}" :icon="file_get_contents(public_path('assets/verfikasi.svg'))" />
        <x-dashboard-card title="Verifikasi Pembayaran Pendaftaran" value="{{ $data['verif_pembayaran_pendaftaran'] }}" :icon="file_get_contents(public_path('assets/verfikasi.svg'))" />
        <x-dashboard-card title="Verifikasi Pembayaran Pelatihan" value="{{ $data['verif_pembayaran_pelatihan'] }}" :icon="file_get_contents(public_path('assets/verfikasi.svg'))" />
    </div>
</x-main-layout>