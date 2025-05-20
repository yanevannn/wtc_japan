<x-main-layout>
    <x-slot:title>Data Siswa</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tabel Siswa Angkatan {{ $angkatan->nomor_angkatan }}
                </h3>
                <div class="space-x-2 mt-4">
                    <a href="{{ route('angkatan.data-nilai-seleksi.index', $angkatan->id) }}">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Nilai Seleksi
                        </button>
                    </a>
                
                    <a href="">
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Nilai Pelatihan
                        </button>
                    </a>
                
                    <a href="">
                        <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                            Hasil Wawancara
                        </button>
                    </a>
                </div>
                
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <x-table>
                    <x-table-header :columns="[
                        'NIS',
                        'Nama Siswa',
                        'Status Pendaftaran',
                        'Status Siswa'
                    ]" :aligns="['left', 'left', 'center', 'center', 'center', 'center']" />
                    <x-table-body>
                        {{-- {{ dd($data) }} --}}
                        @if ($data->isEmpty())
                            <x-table-empty-row />
                        @else
                            @php
                                $statusList = [
                                    1 => 'Belum Lengkap',
                                    2 => 'Menunggu Verifikasi',
                                    3 => 'Gagal Verifikasi Dokumen',
                                    4 => 'Gagal Verifikasi Pembayaran',
                                    5 => 'Gagal Verifikasi Pembayaran & Dokumen',
                                    6 => 'Diterima',
                                ];
                                $statusSiswaList = [
                                    1 => 'Pendaftaran',
                                    2 => 'Seleksi',
                                    3 => 'Pelatihan',
                                    4 => 'Berhenti',
                                    5 => 'Lulus',
                                ];
                            @endphp
                            @foreach ($data as $siswa)
                                <tr>
                                    <x-table-cell>{{ $loop->iteration }}</x-table-cell>
                                    <x-table-cell>{{ $siswa->nis ? $siswa->nis : 'Belum Seleksi' }}</x-table-cell>
                                    <x-table-cell>{{ $siswa->user->fname . ' ' . $siswa->user->lname }}</x-table-cell>
                                    <x-table-cell class="justify-center">
                                        {{ $statusList[$siswa->status_pendaftaran_id] ?? 'Status Tidak Diketahui' }}
                                    </x-table-cell>
                                    <x-table-cell class="justify-center">
                                        {{ $statusSiswaList[$siswa->status_siswa_id] ?? 'Status Tidak Diketahui' }}
                                    </x-table-cell>
                                    <x-table-cell>
                                        <div class="flex justify-center gap-2">
                                            <x-button type="edit"
                                                route="" />
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
