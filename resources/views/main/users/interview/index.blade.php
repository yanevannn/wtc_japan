<x-main-layout>
    <x-slot:title>Interview</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Pelaksanaan Interview Magang </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                {{-- Jadwal Interview Terbaru --}}
                @if (!$jadwal)
                    <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 p-4 rounded-lg">
                        Anda belum memiliki jadwal interview.
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('interview.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-md hover:bg-green-700">
                            Daftar Interview
                        </a>
                    </div>
                @else
                    <h2 class="text-xl font-semibold mb-4">Jadwal Interview Terbaru</h2>
                    <div
                        class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] shadow p-5 mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-2">
                            {{ $jadwal->sesiInterview->perusahaan->nama_perusahaan }}
                        </h3>
                        <p class="text-sm text-gray-800 dark:text-white/90 mb-2">
                            {{ $jadwal->sesiInterview->perusahaan->alamat }}
                        </p>
                        <p class="text-sm text-gray-800 dark:text-white/90 mb-2">
                            <strong>Tipe:</strong> {{ ucfirst($jadwal->sesiInterview->perusahaan->tipe) }}
                        </p>
                        <hr class="my-3 border-gray-300 dark:border-gray-700" />
                        <p class="text-sm text-gray-800 dark:text-white/90">
                            <strong>Tempat / Tanggal Interview:</strong>
                            <br>
                            {{ $jadwal->sesiInterview->tempat }} / 
                            {{ \Carbon\Carbon::parse($jadwal->sesiInterview->tanggal)->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-sm text-gray-800 dark:text-white/90">
                            <strong>Waktu:</strong> 
                            {{ \Carbon\Carbon::parse($jadwal->sesiInterview->jam_mulai)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($jadwal->sesiInterview->jam_selesai)->format('H:i') }}
                        </p>
                    </div>
                @endif

                <div class="sm:py-5 flex items-center justify-between">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Hasil Interview</h3>
                </div>
                <x-table>
                    <x-table-header :columns="['Tempat / Tanggal Interview', 'Waktu', 'Perusahaan', 'Nilai', 'Status']" :aligns="['left', 'left', 'left', 'center', 'center']" :showActionRow="false" />
                    <x-table-body>
                        @if ($data->isEmpty())
                            <x-table-empty-row />
                        @else
                            @foreach ($data as $hasilInterview)
                                <tr>
                                    <x-table-cell>{{ $loop->iteration }}</x-table-cell>
                                    <x-table-cell>{{ $hasilInterview->sesiInterview->tempat }} / 
                                        {{ \Carbon\Carbon::parse($hasilInterview->sesiInterview->tanggal)->translatedFormat('d F Y') }}</x-table-cell>
                                    <x-table-cell>
                                        {{ \Carbon\Carbon::parse($hasilInterview->sesiInterview->jam_mulai)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($hasilInterview->sesiInterview->jam_selesai)->format('H:i') }}
                                    </x-table-cell>
                                    <x-table-cell>{{ $hasilInterview->sesiInterview->perusahaan->nama_perusahaan }}</x-table-cell>
                                    <x-table-cell
                                        class="justify-center">{{ $hasilInterview->nilai !== null ? $hasilInterview->nilai : 'Belum ada nilai' }}</x-table-cell>
                                    <x-table-cell class="justify-center">{{ $hasilInterview->status }}</x-table-cell>
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
