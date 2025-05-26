<x-main-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <div class="flex flex-col gap-4">
        <!-- Profile Card -->
        <div
            class="rounded-xl flex flex-col md:col-span-2 border border-gray-200 p-5 dark:border-gray-800 dark:bg-white/[0.03] text-white">
            <div class="bg-gradient-to-br bg-brand-600 w-full h-32 rounded-t-lg mb-12 relative shadow-xl">
                <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                    <div class="bg-brand-600  rounded-full p-1">
                        <img src="{{ asset('assets/profile.png') }}" alt="Avatar"
                            class="w-24 h-24 rounded-full border-white shadow-2xl">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <h2 class="text-xl font-semibold mt-5 text-gray-800 dark:text-white/90">
                    {{ auth()->user()->fname . ' ' . auth()->user()->lname }}</h2>
                <p class="text-gray-700 dark:text-gray-400 mt-2">Program Magang Jepang 🇯🇵 </p>
                <p class="text-gray-700 dark:text-gray-400 mt-2">
                    @if (empty(auth()->user()->siswa->nis))
                        Status Pendaftaran <br>
                        <span class="text-gray-700 dark:text-gray-200 font-semibold">
                            {{ auth()->user()->siswa->statusPendaftaran->status }}
                        </span>
                    @else
                        NIS :
                        <span class="text-gray-700 dark:text-gray-200 font-semibold">
                            {{ auth()->user()->siswa->nis }}
                        </span>
                    @endif
                </p>

                @if (auth()->user()->siswa && auth()->user()->siswa->statusPendaftaran->status === 'Diterima')
                    <p class="text-gray-700 dark:text-gray-400 mt-2">Grup Whatsapp</p>

                    <a href="{{ auth()->user()->siswa->angkatan->link_grup }}" target="_blank">
                        <button
                            class="items-center gap-2 px-4 py-2 text-sm font-medium text-white uppercase transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600 mt-2 mb-2">
                            Klik untuk bergabung
                        </button>
                    </a>
                @endif
            </div>
        </div>

        @if (auth()->user()->siswa && auth()->user()->siswa->no_ktp === null)
            <!-- Info Card -->
            <div
                class="md:col-span-3 bg-brand-600 text-white rounded-xl shadow p-6 flex flex-col justify-center items-center h-[200px]">
                <p class="sm:col-span-2 text-center text-white font-medium ">
                    Untuk melanjutkan pendaftaran silahka isi data pribadi terlebih dahulu.
                </p>
                <button
                    class="items-center gap-2 px-2 py-2 text-sm font-medium text-white uppercase transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600 mt-4">
                    <a href="{{ route('form.personal.index') }}">Klik untuk mengisi Data Diri</a>
                </button>
            </div>
            {{-- null dipakai karena hasOne / belongsTo --}}
        @elseif(auth()->user()->siswa && auth()->user()->siswa->orangTua === null)
            <!-- Info isi data orang tua -->
            <div
                class="md:col-span-3 bg-brand-600 text-white rounded-xl shadow p-6 flex flex-col justify-center items-center h-[200px]">
                <p class="sm:col-span-2 text-center text-white font-medium ">
                    Data pribadi sudah lengkap. Silahkan lengkapi data orang tua Anda.
                </p>
                <a href="{{ route('form.orang-tua.create') }}">
                    <button
                        class="items-center gap-2 px-4 py-2 text-sm font-medium text-white uppercase transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600 mt-4">
                        Klik untuk mengisi Data Orang Tua
                    </button>
                </a>
            </div>
            {{-- null dipakai karena hasMany / belongsToMany (collection) --}}
        @elseif(auth()->user()->siswa && auth()->user()->siswa->dokumen->isEmpty())
            <!-- Info isi data orang tua -->
            <div
                class="md:col-span-3 bg-brand-600 text-white rounded-xl shadow p-6 flex flex-col justify-center items-center h-[200px]">
                <p class="sm:col-span-2 text-center text-white font-medium ">
                    Data pribadi & Orang Tua sudah lengkap. Selanjutnya lengkapi data dokumen Anda.
                </p>
                <a href="{{ route('form.dokumen.create') }}">
                    <button
                        class="items-center gap-2 px-4 py-2 text-sm font-medium text-white uppercase transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600 mt-4">
                        Klik untuk mengisi Data Dokumen
                    </button>
                </a>
            </div>
        @elseif(auth()->user()->siswa && auth()->user()->siswa->pembayaran->isEmpty())
            <!-- Info isi data orang tua -->
            <div
                class="md:col-span-3 bg-brand-600 text-white rounded-xl shadow p-6 flex flex-col justify-center items-center h-[200px]">
                <p class="sm:col-span-2 text-center text-white font-medium ">
                    Seluruh data pribadi, Orang Tua, dan Dokumen telah lengkap. Silakan melanjutkan ke tahap pembayaran
                    pendaftaran.
                </p>
                <a href="{{ route('pembayaranpendaftaran') }}">
                    <button
                        class="items-center gap-2 px-4 py-2 text-sm font-medium text-white uppercase transition rounded-lg bg-success-500 shadow-theme-xs hover:bg-success-600 mt-4">
                        Klik untuk Melakukan Pembayaran
                    </button>
                </a>
            </div>
        @elseif(auth()->user()->siswa && auth()->user()->siswa->statusPendaftaran->status === 'Menunggu Verifikasi')
            <!-- Info isi data orang tua (Versi Lebih Menarik) -->
            <div
                class="md:col-span-3 bg-yellow-500 dark:bg-yellow-400/80 text-white rounded-2xl shadow-lg p-8 flex flex-col justify-center items-center h-[220px] transition-all duration-300 hover:bg-yellow-500/90 dark:hover:bg-yellow-400/90">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mb-4 text-white drop-shadow" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2l4-4m7 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl font-semibold mb-2">Data Sudah Lengkap</h3>
                <p class="text-center text-sm sm:text-base max-w-lg">
                    Menunggu verifikasi pembayaran & dokumen dari Admin. <br>
                    Silakan cek secara berkala untuk melihat status pendaftaran Anda.
                </p>
            </div>
        @elseif(
            (auth()->user()->siswa && auth()->user()->siswa->statusPendaftaran->status === 'Gagal Verifikasi Pembayaran') ||
                auth()->user()->siswa->statusPendaftaran->status === 'Gagal Verifikasi Dokumen')
            <div
                class="md:col-span-3 bg-yellow-500 dark:bg-yellow-400/80 text-white rounded-2xl shadow-lg p-8 flex flex-col justify-center items-center h-[220px] transition-all duration-300 hover:bg-yellow-500/90 dark:hover:bg-yellow-400/90">
                <div class="flex items-center justify-center gap-2 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-info-icon lucide-info">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 16v-4" />
                        <path d="M12 8h.01" />
                    </svg>
                    <h3 class="text-xl font-semibold leading-none">Data Sudah Lengkap</h3>
                </div>


                @if (auth()->user()->siswa->statusPendaftaran->status === 'Gagal Verifikasi Dokumen')
                    <p class="text-center text-sm sm:text-base max-w-lg mb-4">
                        Verifikasi dokumen gagal. Silakan perbaiki dokumen Anda.
                    </p>
                    <a href="{{ route('dokumen.index') }}"
                        class="inline-block bg-white text-yellow-600 px-6 py-2 rounded font-semibold hover:bg-yellow-100 transition">
                        Perbaiki Data Dokumen
                    </a>
                @elseif(auth()->user()->siswa->statusPendaftaran->status === 'Gagal Verifikasi Pembayaran')
                    <p class="text-center text-sm sm:text-base max-w-lg mb-4">
                        Verifikasi pembayaran gagal. Silakan upload ulang bukti pembayaran Anda.
                    </p>
                    <a href="{{ route('pembayaranpendaftaran') }}"
                        class="inline-block bg-white text-yellow-600 px-6 py-2 rounded font-semibold hover:bg-yellow-100 transition">
                        Perbaiki Pembayaran
                    </a>
                @endif
            </div>
        @elseif(auth()->user()->siswa && auth()->user()->siswa->status_siswa_id === 4)
            @php
                $pembayaran = auth()->user()->siswa->pembayaranPelatihan;
            @endphp

            @if (!$pembayaran)
                {{-- Belum melakukan pembayaran --}}
                <div
                    class="md:col-span-3 bg-yellow-500 dark:bg-yellow-400/80 text-white rounded-2xl shadow-lg p-8 flex flex-col justify-center items-center h-[220px] transition-all duration-300 hover:bg-yellow-500/90 dark:hover:bg-yellow-400/90">
                    <div class="flex items-center justify-center gap-2 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-info-icon lucide-info">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 16v-4" />
                            <path d="M12 8h.01" />
                        </svg>
                        <h3 class="text-xl font-semibold leading-none">Pembayaran Pelatihan Belum Dilakukan</h3>
                    </div>
                    <p class="text-center text-sm sm:text-base max-w-lg mb-4">
                        Silakan melakukan pembayaran pelatihan untuk mengikuti kegiatan pelatihan di WTC.
                    </p>
                    <a href="{{ route('pembayaranpelatihan.create') }}"
                        class="inline-block bg-white text-yellow-600 px-6 py-2 rounded font-semibold hover:bg-yellow-100 transition">
                        Bayar Pelatihan
                    </a>
                </div>
            @elseif ($pembayaran->status === 'pending')
                {{-- Sudah bayar tapi menunggu verifikasi --}}
                <div
                    class="md:col-span-3 bg-brand-600 text-white rounded-2xl shadow-lg p-8 flex flex-col justify-center items-center h-[220px] transition-all duration-300 hover:bg-brand-600/90">
                    <h3 class="text-xl font-semibold mb-2">Menunggu Verifikasi</h3>
                    <p class="text-center text-sm sm:text-base max-w-lg">
                        Bukti pembayaran pelatihan Anda sedang diverifikasi.
                        Silakan cek secara berkala verifikasi bukti pembayaran Anda.
                    </p>
                </div>
            @elseif ($pembayaran->status === 'rejected')
                {{-- Gagal verifikasi --}}
                <div
                    class="md:col-span-3 bg-red-600  text-white rounded-2xl shadow-lg p-8 flex flex-col justify-center items-center h-[220px] transition-all duration-300 hover:bg-red-600/90 ">
                    <h3 class="text-xl font-semibold mb-2">Pembayaran Ditolak</h3>
                    <p class="text-center text-sm sm:text-base max-w-lg mb-4">
                        Bukti pembayaran pelatihan ditolak. Silakan upload ulang bukti yang benar.
                    </p>
                    <a href="{{ route('pembayaranpelatihan.index') }}"
                        class="inline-block bg-white text-red-600 px-6 py-2 rounded font-semibold hover:bg-red-100 transition">
                        Upload Ulang Bukti
                    </a>
                </div>
            @endif
        @elseif(auth()->user()->siswa && auth()->user()->siswa->status_siswa_id === 6)
            @php
                $siswa = auth()->user()->siswa;
                $pendaftaranPertama = $siswa->pendaftaranInterview()->first();
            @endphp

            @if (!$pendaftaranPertama)
                <!-- Belum mendaftar interview -->
                <div
                    class="md:col-span-3 bg-yellow-500 dark:bg-yellow-400/80 text-white rounded-2xl shadow-lg p-8 flex flex-col justify-center items-center h-[220px] transition-all duration-300 hover:bg-yellow-500/90 dark:hover:bg-yellow-400/90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mb-4 text-white drop-shadow" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M12 18a6 6 0 100-12 6 6 0 000 12z" />
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">Belum Mendaftar Interview</h3>
                    <p class="text-center text-sm sm:text-base max-w-lg">
                        Silakan mendaftar interview terlebih dahulu untuk melanjutkan proses seleksi.
                    </p>
                    <a href="{{ route('interview.create') }}"
                        class="mt-4 px-4 py-2 bg-white text-yellow-700 font-semibold rounded hover:bg-gray-100">
                        Daftar Interview
                    </a>
                </div>
            @else
                <!-- Sudah mendaftar interview -->
                <div
                    class="md:col-span-3 bg-brand-600 dark:bg-brand-600/80 text-white rounded-2xl shadow-lg p-8 flex flex-col justify-center items-center h-[220px] transition-all duration-300 hover:bg-brand-600/90 dark:hover:bg-brand-600/90">
                    <h3 class="text-xl font-semibold mb-2">Interview Terjadwal</h3>
                    <p class="text-center text-sm sm:text-base max-w-lg">
                        Anda telah mendaftar interview. Silakan ikuti interview sesuai jadwal yang telah Anda pilih.
                        <br>
                        Pastikan hadir tepat waktu.
                    </p>
                </div>
            @endif
        @elseif(auth()->user()->siswa && auth()->user()->siswa->status_siswa_id === 7)
            @php
                $siswa = auth()->user()->siswa;
                $semuaPendaftaran = $siswa->pendaftaranInterview()->orderByDesc('created_at')->get();
                $pendaftaranTerakhir = $semuaPendaftaran->first();
            @endphp

            @if (!$pendaftaranTerakhir || $pendaftaranTerakhir->status === 'tidak lolos')
                <!-- Belum mendaftar ulang atau status terakhir tidak lolos -->
                <div
                    class="md:col-span-3 bg-red-600 dark:bg-red-600/80 text-white rounded-2xl shadow-lg p-8 flex flex-col justify-center items-center h-[220px] transition-all duration-300 hover:bg-red-600/90 dark:hover:bg-red-600/90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mb-4 text-white drop-shadow"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">Anda Tidak Lolos Interview Sebelumnya</h3>
                    <p class="text-center text-sm sm:text-base max-w-lg">
                        Silakan mendaftar ulang untuk interview. Klik tombol di bawah untuk melihat jadwal sesi
                        interview yang tersedia.
                    </p>
                    <a href="{{ route('interview.create') }}"
                        class="mt-4 px-4 py-2 bg-white text-red-600 font-semibold rounded hover:bg-gray-100">
                        Daftar Interview
                    </a>
                </div>
            @elseif($pendaftaranTerakhir->status === 'pending')
                <!-- Sudah mendaftar ulang -->
                <div
                    class="md:col-span-3 bg-brand-600 dark:bg-brand-600/80 text-white rounded-2xl shadow-lg p-8 flex flex-col justify-center items-center h-[220px] transition-all duration-300 hover:bg-brand-600/90 dark:hover:bg-brand-600/90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 mb-4 text-white drop-shadow"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2l4-4m7 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">Interview Anda Akan Dilaksanakan</h3>
                    <p class="text-center text-sm sm:text-base max-w-lg">
                        Silakan ikuti interview ulang sesuai jadwal yang telah Anda pilih. <br>
                        Pastikan hadir tepat waktu.
                    </p>
                </div>
            @endif
        @elseif(auth()->user()->siswa && auth()->user()->siswa->status_siswa_id === 8)
            @php
                $siswa = auth()->user()->siswa;
                $pendaftaranLolos = $siswa
                    ->pendaftaranInterview()
                    ->where('status', 'lolos')
                    ->latest()
                    ->with('sesiInterview.perusahaan')
                    ->first();
            @endphp

            @if ($pendaftaranLolos)
                <div
                    class="md:col-span-3 bg-green-500 dark:bg-green-400/80 text-white rounded-2xl shadow-lg p-8 flex flex-col justify-center items-center h-[220px] transition-all duration-300 hover:bg-green-500/90 dark:hover:bg-green-400/90">
                    <h3 class="text-xl font-semibold mb-2">🎉 Selamat Anda Lulus Interview!</h3>
                    <p class="text-center text-sm sm:text-base max-w-lg">
                        Anda dinyatakan <strong>LOLOS</strong> interview di perusahaan:</p>
                    <p class="text-center text-lg font-bold underline text-white mt-1">
                        {{ $pendaftaranLolos->sesiInterview->perusahaan->nama_perusahaan ?? '-' }}</p>
                    <p class="text-center text-sm sm:text-base max-w-lg mt-2"> Selamat bergabung dan semoga sukses
                        dalam proses selanjutnya.</p>
                </div>
            @endif
        @endif

        <div class="mt-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Pengumuman</h2>
            <p class="text-sm text-gray-600 dark:text-white/70 mb-4"> Informasi terkini terkait WTC2JAPAN</p>
            <div class="flex flex-col gap-4">
                @foreach ($announcements as $information)
                    <x-announcement :title="$information->judul" :description="$information->deskripsi"
                        file="{{ asset('storage/pengumuman_files/' . $information->file) }}"
                        date="{{ $information->created_at->diffForHumans() }}" />
                @endforeach
            </div>

        </div>
    </div>
</x-main-layout>
