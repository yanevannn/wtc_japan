<x-main-layout>
    <x-slot:title>Data Siswa {{ $gelombang->nama_gelombang }}</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tabel Siswa Seleksi {{ $gelombang->nama_gelombang }}
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <x-table>
                    <x-table-header :columns="[
                        'Nama Siswa',
                        'Status',
                        'Nilai Bahasa',
                        'Nilai Fisik',
                        'Nilai Matematika',
                        'Nilai Koran',
                    ]" :aligns="['left', 'center', 'center', 'center', 'center', 'center']" />
                    <x-table-body>
                        {{-- {{ dd($data) }} --}}
                        @if ($data->isEmpty())
                            <x-table-empty-row />
                        @else
                            @php
                                $statusList = [
                                    1 => 'Belum Lengkap',
                                    2 => 'Menunggu Verifikasi',
                                    3 => 'Gagal Verifikasi',
                                    4 => 'Ditolak',
                                    5 => 'Diterima',
                                ];
                            @endphp
                            @foreach ($data as $siswa)
                                <tr>
                                    <x-table-cell>{{ $loop->iteration }}</x-table-cell>
                                    <x-table-cell>{{ $siswa->user->fname . ' ' . $siswa->user->lname }}</x-table-cell>
                                    <x-table-cell class="justify-center">
                                        {{ $statusList[$siswa->status_pendaftaran_id] ?? 'Status Tidak Diketahui' }}
                                    </x-table-cell>
                                    <x-table-cell
                                        class="justify-center">{{ optional($siswa->nilaiSeleksi)->huruf_jepang ?? 0 }}</x-table-cell>
                                    <x-table-cell
                                        class="justify-center">{{ optional($siswa->nilaiSeleksi)->fisik ?? 0 }}</x-table-cell>
                                    <x-table-cell
                                        class="justify-center">{{ optional($siswa->nilaiSeleksi)->matematika ?? 0 }}</x-table-cell>
                                    <x-table-cell
                                        class="justify-center">{{ optional($siswa->nilaiSeleksi)->koran ?? 0 }}</x-table-cell>
                                    <x-table-cell>
                                        <div class="flex justify-center gap-2">
                                            <x-button type="edit"
                                                route="{{ route('gelombang.edit', $siswa->id) }}" />
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
