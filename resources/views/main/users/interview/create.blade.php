<x-main-layout>
    <x-slot:title>Pendaftaran Interview</x-slot:title>
    <div class="space-y-5 sm:space-y-6">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Pendaftaran Interview Perusahaan
                </h3>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if ($data->isEmpty())
                        <div class="col-span-1 md:col-span-2 lg:col-span-3">
                            <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 p-4 rounded-lg">
                                Tidak ada perusahaan yang tersedia untuk pendaftaran interview saat ini.
                            </div>
                        </div>
                    @else
                        @foreach ($data as $perusahaan)
                            <div
                                class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] shadow p-5 ">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-2">
                                    {{ $perusahaan->nama_perusahaan }}
                                </h3>
                                <p class="text-sm text-gray-800 dark:text-white/90 mb-2">{{ $perusahaan->alamat }}</p>
                                <p class="text-sm  text-gray-800 dark:text-white/90"><strong>Tipe:</strong>
                                    {{ ucfirst($perusahaan->tipe) }}</p>
                                <p class="text-sm mb-4 text-gray-800 dark:text-white/90 text-justify"><strong>Tentang
                                        Perusahaan:<br></strong>
                                    {{ ucfirst($perusahaan->deskripsi) }}</p>

                                <div class="space-y-2">
                                    @forelse ($perusahaan->sesiInterview as $sesi)
                                        <div
                                            class="bg-gray-50 dark:bg-white/[0.05] border border-gray-200 dark:border-white/[0.1] p-3 rounded-lg">
                                            <p class="text-sm text-gray-700 dark:text-white/90">
                                                <strong class="text-gray-800 dark:text-white">Tempat / Tanggal:</strong>
                                                <br>
                                                {{ $sesi->tempat }} / 
                                                {{ \Carbon\Carbon::parse($sesi->tanggal)->translatedFormat('d F Y') }}
                                            </p>
                                            <p class="text-sm text-gray-700 dark:text-white/90">
                                                <strong class="text-gray-800 dark:text-white">Jam:</strong>
                                                {{ \Carbon\Carbon::parse($sesi->jam_mulai)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($sesi->jam_selesai)->format('H:i') }}
                                            </p>
                                            <p class="text-sm text-gray-700 dark:text-white/90">
                                                <strong class="text-gray-800 dark:text-white">Kuota:</strong>
                                                {{ $sesi->kuota }}
                                            </p>
                                            @php
                                                $sisaKuota = $sesi->kuota - $sesi->pendaftaran_interview_count;
                                            @endphp
                                            <p class="text-sm text-gray-700 dark:text-white/90">
                                                <strong class="text-gray-800 dark:text-white">Sisa Kuota:</strong>
                                                {{ $sisaKuota }}
                                            </p>
                                            <div class="mt-2">
                                                @if ($sisaKuota > 0)
                                                    <form action="{{ route('interview.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="sesi_interview_id"
                                                            value="{{ $sesi->id }}">
                                                        <button type="submit"
                                                            class="text-sm px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                                            Daftar Sesi Ini
                                                        </button>
                                                    </form>
                                                @else
                                                    <button
                                                        class="text-sm px-3 py-1 bg-gray-400 text-white rounded cursor-not-allowed"
                                                        disabled>
                                                        Kuota Penuh
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-sm text-gray-500 dark:text-gray-400 italic">Belum ada sesi
                                            interview
                                            tersedia.</p>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
