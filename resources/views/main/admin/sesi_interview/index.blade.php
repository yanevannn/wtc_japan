<x-main-layout>
    <x-slot:title>Jadwal Interview</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tabel Penjadwalan Sesi Interview Magang WTC
                </h3>
                <x-button type="add" route="{{ route('sesi-interview.create') }}" />
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <x-table>
                    <x-table-header :columns="['Nama Perusahaan', 'Tanggal', 'Jam Interview', 'Kuota', 'Jumlah Pendaftar']" :aligns="['left', 'center', 'center', 'center', 'center']"/>
                    <x-table-body>
                        @if ($data->isEmpty())
                            <x-table-empty-row />
                        @else
                            @foreach ($data as $sesi_interview)
                                <tr>
                                    <x-table-cell>{{ $loop->iteration }}</x-table-cell>
                                    <x-table-cell>{{ $sesi_interview->perusahaan->nama_perusahaan }}</x-table-cell>
                                    <x-table-cell class="justify-center">{{ $sesi_interview->tanggal }}</x-table-cell>
                                    <x-table-cell class="justify-center">{{ \Carbon\Carbon::parse($sesi_interview->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($sesi_interview->jam_selesai)->format('H:i') }}
                                    </x-table-cell>
                                    <x-table-cell class="justify-center">{{ $sesi_interview->kuota }}</x-table-cell>
                                    <x-table-cell class="justify-center">0</x-table-cell>
                                    <x-table-cell>
                                        <div class="flex justify-center gap-2">
                                            <x-button type="edit"
                                                route="{{ route('sesi-interview.edit', $sesi_interview->id) }}" />
                                            <x-button type="delete"
                                                route="{{ route('sesi-interview.destroy', $sesi_interview->id) }}" />
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
