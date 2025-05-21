<x-main-layout>
    <x-slot:title>Nilai Seleksi</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    @if ($data)
                    Hasil Seleksi Pendaftaran {{ auth()->user()->fname . ' ' . auth()->user()->lname }}
                    @else
                    Anda belum mengikuti seleksi
                    @endif
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <x-table>
                    <x-table-header :columns="['Penilaian', 'Nilai', 'Nilai Akhir']" :aligns="['left', 'center', 'center']" :showActionRow="false" />
                    <x-table-body>
                        {{-- {{ dd($data) }} --}}
                        @if (!$data)
                            <x-table-empty-row />
                        @else
                            @php
                                function nilaiHuruf($nilai)
                                {
                                    if ($nilai >= 90) {
                                        return 'A';
                                    }
                                    if ($nilai >= 80) {
                                        return 'B';
                                    }
                                    if ($nilai >= 70) {
                                        return 'C';
                                    }
                                    if ($nilai >= 60) {
                                        return 'D';
                                    }
                                    return 'E';
                                }
                            @endphp
                            <tr>
                                <x-table-cell>1</x-table-cell>
                                <x-table-cell>Hiragana</x-table-cell>
                                <x-table-cell class="justify-center">{{ $data->hiragana }}</x-table-cell>
                                <x-table-cell class="justify-center">{{ nilaiHuruf($data->hiragana) }}</x-table-cell>
                            </tr>
                            <tr>
                                <x-table-cell>2</x-table-cell>
                                <x-table-cell>Katakana</x-table-cell>
                                <x-table-cell class="justify-center">{{ $data->katakana }}</x-table-cell>
                                <x-table-cell class="justify-center">{{ nilaiHuruf($data->katakana) }}</x-table-cell>
                            </tr>
                            <tr>
                                <x-table-cell>3</x-table-cell>
                                <x-table-cell>Kanji</x-table-cell>
                                <x-table-cell class="justify-center">{{ $data->kanji }}</x-table-cell>
                                <x-table-cell class="justify-center">{{ nilaiHuruf($data->kanji) }}</x-table-cell>
                            </tr>
                            <tr>
                                <x-table-cell>4</x-table-cell>
                                <x-table-cell>Bunpou</x-table-cell>
                                <x-table-cell class="justify-center">{{ $data->bunpou }}</x-table-cell>
                                <x-table-cell class="justify-center">{{ nilaiHuruf($data->bunpou) }}</x-table-cell>
                            </tr>
                            <tr>
                                <x-table-cell>5</x-table-cell>
                                <x-table-cell>Choukai</x-table-cell>
                                <x-table-cell class="justify-center">{{ $data->choukai }}</x-table-cell>
                                <x-table-cell class="justify-center">{{ nilaiHuruf($data->choukai) }}</x-table-cell>
                            </tr>
                            <tr>
                                <x-table-cell>6</x-table-cell>
                                <x-table-cell>Kaiwa</x-table-cell>
                                <x-table-cell class="justify-center">{{ $data->kaiwa }}</x-table-cell>
                                <x-table-cell class="justify-center">{{ nilaiHuruf($data->kaiwa) }}</x-table-cell>
                            </tr>
                            <tr>
                                <x-table-cell>7</x-table-cell>
                                <x-table-cell>Dokkai</x-table-cell>
                                <x-table-cell class="justify-center">{{ $data->dokkai }}</x-table-cell>
                                <x-table-cell class="justify-center">{{ nilaiHuruf($data->dokkai) }}</x-table-cell>
                            </tr>
                            
                        @endif
                    </x-table-body>
                </x-table>

                @if ($data)
                <div class="mt-5 flex justify-end">
                    <a href="{{ route('nilaipelatihan.pdf') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Download Nilai
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
</x-main-layout>
