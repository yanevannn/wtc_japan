<x-main-layout>
    <x-slot:title>Angkatan</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tabel Angkatan
                </h3>
                <x-button type="add" route="{{ route('angkatan.create') }}" />
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <x-table>
                    <x-table-header :columns="['Nomor angkatan', 'Tahun', 'Jumlah Pendaftar', 'Status', 'Grup WA', 'Data Pendaftar']" :aligns="['left', 'left', 'center', 'center', 'center', 'center']" :widths="['', '', 'w-18', '', 'w-20', '']" />
                    <x-table-body>
                        @if ($data->isEmpty())
                            <x-table-empty-row />
                        @else
                        @foreach ($data as $angkatan)
                                <tr>
                                    <x-table-cell>{{ $loop->iteration }}</x-table-cell>
                                    <x-table-cell>{{ $angkatan->nomor_angkatan }}</x-table-cell>
                                    <x-table-cell>{{ $angkatan->tahun }}</x-table-cell>
                                    <x-table-cell
                                        class="justify-center">{{ $angkatan->jumlah_pendaftar }}</x-table-cell>
                                    <x-table-cell class="justify-center">
                                        @if ($angkatan->status === 'open')
                                            <x-badge>open</x-badge>
                                        @else
                                            <x-badge type="error">close</x-badge>
                                        @endif
                                    </x-table-cell>
                                    <x-table-cell>
                                        <a class="text-sm text-blue-600 hover:text-blue-500 underline underline-offset-1 hover:underline-offset-2"
                                            target="_blank"
                                            href="{{ $angkatan->link_grup }}">{{ $angkatan->link_grup }}</a>
                                    </x-table-cell>
                                    <x-table-cell class="justify-center">
                                        <a class="text-sm text-blue-600 hover:text-blue-500 underline underline-offset-1 hover:underline-offset-2"
                                            href="{{ route('angkatan.data-siswa.index', $angkatan->id) }}">Lihat
                                            Data</a>
                                    </x-table-cell>
                                    <x-table-cell>
                                        <div class="flex justify-center gap-2">

                                            <x-button type="edit"
                                                route="{{ route('angkatan.edit', $angkatan->id) }}" />
                                            <x-button type="delete"
                                                route="{{ route('angkatan.destroy', $angkatan->id) }}" />
                                        </div>
                                    </x-table-cell>
                                </tr>
                            @endforeach
                        @endif
                    </x-table-body>
                </x-table>
            </div>
        </div>
    </div>
    </div>
</x-main-layout>
