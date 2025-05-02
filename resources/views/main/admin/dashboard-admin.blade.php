<x-main-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <x-dashboard-card title="Jumlah Pendaftar" value="{{ $data }}" :icon="file_get_contents(public_path('assets/users.svg'))" />
        <x-dashboard-card title="Verifikasi Pendaftaran" value="10" :icon="file_get_contents(public_path('assets/status.svg'))" />
    </div>
</x-main-layout>