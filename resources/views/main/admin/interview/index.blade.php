<x-main-layout>
    <x-slot:title>Input Hasil Interview</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Tabel Hasil Interview Magang WTC
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <x-table>
                    <x-table-header :columns="['Nama Siswa', 'NIS', 'Perusahaan', 'Tanggal Interview', 'Status', 'Nilai']" :aligns="['left', 'left', 'left', 'left', 'left', 'left']" />
                    <x-table-body>
                        @if ($data->isEmpty())
                            <x-table-empty-row />
                        @else
                            @foreach ($data as $hasil)
                                <tr>
                                    <x-table-cell>{{ $loop->iteration }}</x-table-cell>
                                    <x-table-cell>{{ $hasil->siswa->user->fname . ' ' . $hasil->siswa->user->lname }}</x-table-cell>
                                    <x-table-cell>{{ $hasil->siswa->nis }}</x-table-cell>
                                    <x-table-cell>{{ $hasil->sesiInterview->perusahaan->nama_perusahaan }}</x-table-cell>
                                    <x-table-cell>{{ $hasil->sesiInterview->tanggal }}</x-table-cell>
                                    <x-table-cell>{{ $hasil->status }}</x-table-cell>
                                    <x-table-cell>{{ $hasil->nilai !== null ? $hasilInterview->nilai : 'Belum ada nilai' }}</x-table-cell>
                                    <x-table-cell>
                                        <div class="flex justify-center gap-2">
                                            <!-- Tombol trigger modal -->
                                            <button
                                                class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700"
                                                onclick="openModal(
                                                    '{{ $hasil->id }}',
                                                    '{{ $hasil->siswa->user->fname }} {{ $hasil->siswa->user->lname }}',
                                                    '{{ $hasil->nilai }}',
                                                    '{{ $hasil->status }}',
                                                    '{{ $hasil->siswa->nis }}',
                                                    '{{ $hasil->sesiInterview->perusahaan->nama_perusahaan }}')">
                                                Input Nilai
                                            </button>

                                        </div>
                                    </x-table-cell>
                                </tr>
                            @endforeach
                        @endif
                    </x-table-body>
                </x-table>
                <!-- Modal -->
                <div id="inputNilaiModal"
                    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 px-2">
                    <div class="bg-white rounded-lg p-6 w-full max-w-md lg:ml-[390px] shadow-lg">
                        <h2 class="text-lg font-semibold mb-4">Input Nilai Interview</h2>
                        <form method="POST" action="{{ route('hasil-interview.store') }}">
                            @csrf

                            <input type="hidden" name="id" id="modal-id" value="{{ old('id') }}">
                            <input type="hidden" name="name" id="modal-name" value="{{ old('name') }}">
                            <input type="hidden" name="nis" id="modal-nis" value="{{ old('nis') }}">
                            <input type="hidden" name="perusahaan" id="modal-perusahaan"
                                value="{{ old('perusahaan') }}">

                            <p class="mb-2 text-sm text-gray-700">Nama Siswa: <span class="font-semibold"
                                    id="modal-name-display"></span></p>
                            <p class="mb-2 text-sm text-gray-700">NIS: <span class="font-semibold"
                                    id="modal-nis-display"></span></p>
                            <p class="mb-4 text-sm text-gray-700">Perusahaan Interview: <span class="font-semibold"
                                    id="modal-perusahaan-display"></span></p>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Nilai</label>
                                <input type="number" name="nilai" id="modal-nilai" value="{{ old('nilai') }}"
                                    min="0" max="100"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    placeholder="Masukkan nilai interview" required>
                                @error('nilai')
                                    <x-alert-validation message="{{ $message }}" />
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <div class="flex gap-x-2">
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="status" value="pending"
                                            {{ old('status') == 'pending' ? 'checked' : '' }}
                                            class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <span class="text-sm text-gray-700">Pending</span>
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="status" value="lolos"
                                            {{ old('status') == 'lolos' ? 'checked' : '' }}
                                            class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <span class="text-sm text-gray-700">Lolos</span>
                                    </label>
                                    <label class="flex items-center gap-2">
                                        <input type="radio" name="status" value="tidak lolos"
                                            {{ old('status') == 'tidak lolos' ? 'checked' : '' }}
                                            class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <span class="text-sm text-gray-700">Tidak Lolos</span>
                                    </label>
                                </div>
                                @error('status')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end space-x-2">
                                <button type="button" onclick="closeModal()"
                                    class="px-3 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Batal</button>
                                <button type="submit"
                                    class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    function openModal(id, name, nilai, status, nis, perusahaan) {
                        // Isi input hidden (untuk old())
                        document.getElementById('modal-id').value = id;
                        document.getElementById('modal-name').value = name;
                        document.getElementById('modal-nis').value = nis;
                        document.getElementById('modal-perusahaan').value = perusahaan;

                        // Tampilkan pada span
                        document.getElementById('modal-name-display').innerText = name || '';
                        document.getElementById('modal-nis-display').innerText = nis || '';
                        document.getElementById('modal-perusahaan-display').innerText = perusahaan || '';

                        // Isi nilai input number
                        document.getElementById('modal-nilai').value = (nilai === 'null' || nilai === null) ? '' : nilai;

                        // Set radio button status
                        if (status) {
                            const radio = document.querySelector(`input[name="status"][value="${status}"]`);
                            if (radio) {
                                radio.checked = true;
                            }
                        }

                        // Tampilkan modal
                        const modal = document.getElementById('inputNilaiModal');
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                    }

                    function closeModal() {
                        const modal = document.getElementById('inputNilaiModal');
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }

                    // Buka modal otomatis jika ada error validasi Laravel
                    @if ($errors->any())
                        window.addEventListener('DOMContentLoaded', () => {
                            openModal(
                                "{{ old('id') }}",
                                "{{ old('name') }}",
                                "{{ old('nilai') }}",
                                "{{ old('status') }}",
                                "{{ old('nis') }}",
                                "{{ old('perusahaan') }}"
                            );
                        });
                    @endif
                </script>

            </div>
        </div>
    </div>
    </div>
</x-main-layout>
