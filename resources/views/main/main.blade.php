<x-main-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
        <x-dashboard-card title="Jumlah Pendaftar" value="10" :icon="file_get_contents(public_path('assets/users.svg'))" />
    </div>
</x-main-layout>
