<x-main-layout>
    <x-slot:title>Nilai Seleksi Siswa</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tabel Nilai Seleksi Siswa Angkatan {{ $angkatan->nomor_angkatan }}
                </h3>
                <a href="{{ route('angkatan.data-nilai-seleksi.download-template', $angkatan->id) }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Download Template Input Nilai
                </a>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div class="mb-2">
                    <!-- Form untuk Upload File Excel -->
                    <form action="{{ route('angkatan.data-nilai-seleksi.upload-nilai', $angkatan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- File Input Field -->
                        <div>
                            <label for="nilai_file"
                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Upload File Nilai Seleksi {{ $angkatan->nomor_angkatan }}
                            </label>
                            <input name="nilai_file" type="file" accept=".xlsx,.xls"
                                class="focus:border-ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 shadow-theme-xs transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pl-3.5 file:pr-3 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-none focus:file:ring-brand-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">

                            <!-- Error Message -->
                            <div class="text-red-500 text-sm mt-2">
                                <!-- Tampilkan error jika ada -->
                                @error('nilai_file')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <x-button type="submit">Upload Nilai</x-button>
                    </form>
                </div>
                <x-table>
                    <x-table-header :columns="[
                        'Nama Siswa',
                        'Status Pendaftaran',
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
                                    3 => 'Gagal Verifikasi Dokumen',
                                    4 => 'Gagal Verifikasi Pembayaran',
                                    5 => 'Gagal Verifikasi Pembayaran & Dokumen',
                                    6 => 'Diterima',
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
