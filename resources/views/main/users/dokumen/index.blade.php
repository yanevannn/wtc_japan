<x-main-layout>
    <x-slot:title>Dokumen Pendaftaran</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tabel Dokumen Pendaftaran
                </h3>
                @if (auth()->user()->siswa->dokumen->isEmpty())
                    <x-button type="add" route="{{ route('form.dokumen.create') }}" />
                @endif
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <x-table>
                    <x-table-header :columns="['Jenis Dokumen', 'Status verifikasi', 'File']" :widths="['w-18', '', '']" />
                    <x-table-body>
                        @if ($data->isEmpty())
                            <x-table-empty-row />
                        @else
                            @foreach ($data as $dokumen)
                                <tr>
                                    <x-table-cell>{{ $loop->iteration }}</x-table-cell>
                                    <x-table-cell>{{ \App\Models\Dokumen::getJenisDokumenHumanReadable($dokumen->jenis_dokumen) }}</x-table-cell>
                                    <x-table-cell>{{ $dokumen->status }}</x-table-cell>
                                    <x-table-cell>
                                        <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank"
                                            class="text-sm text-blue-600 hover:text-blue-500 underline underline-offset-1 hover:underline-offset-2">
                                            Lihat Dokumen</a>
                                    </x-table-cell>
                                    <x-table-cell>
                                        <div class="flex justify-center gap-2">
                                            <x-button type="edit"
                                                route="{{ route('form.dokumen.edit', $dokumen->jenis_dokumen) }}" />
                                        </div>
                                    </x-table-cell>
                                </tr>
                            @endforeach
                        @endif
                    </x-table-body>
                </x-table>
                <div class="mt-5 text-gray-800 dark:text-white/90">
                    <h2>Catatan :</h2>
                    <ul class="list-disc pl-5 text-base">
                        <li>Pastikan dokumen yang diunggah jelas dan terbaca dengan baik.</li>
                        <li>Pastikan Jenis dokumen sesuai dengan file yang di upload.</li>
                        <li>Jika status dokumen adalah <strong>pending</strong>, berarti dokumen sedang menunggu
                            verifikasi
                            dari admin.</li>
                        <li>Jika status dokumen adalah <strong>rejected</strong>, silakan unggah ulang dokumen yang
                            ditolak.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-main-layout>
