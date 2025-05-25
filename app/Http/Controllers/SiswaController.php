<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\StatusPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        return view('main.users.form.personal');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|numeric|digits:16|unique:tb_siswa,no_ktp',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'golongan_darah' => 'required|string|in:A,B,AB,O',
            'agama' => 'required|string|max:50',
            'wa' => 'required',
            'instagram' => 'nullable|string|max:50',
        ]);

        // dd($request->all());

        $data = [
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'no_ktp' => $request->input('no_ktp'),
            'tinggi_badan' => $request->input('tinggi_badan'),
            'berat_badan' => $request->input('berat_badan'),
            'golongan_darah' => $request->input('golongan_darah'),
            'agama' => $request->input('agama'),
            'wa' => $request->input('wa'),
            'instagram' => $request->input('instagram')
        ];
        // Cari data siswa milik user yang login
        $siswa = Siswa::where('user_id', auth()->id())->firstOrFail();
        $siswa->update($data);
        return redirect()->route('dashboard')->with('success', 'Data anda berhasil disimpan.');
    }

    public function edit()
    {
        $data = Siswa::where('user_id', auth()->id())->firstOrFail();
        return view('main.users.form.personal-edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::where('id', $id)->first();
        // dd($siswa);
        $request->validate([
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|numeric|digits:16|unique:tb_siswa,no_ktp,' . $siswa->id,
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'golongan_darah' => 'required|string|in:A,B,AB,O',
            'agama' => 'required|string|max:50',
            'wa' => 'required',
            'instagram' => 'nullable|string|max:50',
        ]);

        $siswa->update([
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'no_ktp' => $request->input('no_ktp'),
            'tinggi_badan' => $request->input('tinggi_badan'),
            'berat_badan' => $request->input('berat_badan'),
            'golongan_darah' => $request->input('golongan_darah'),
            'agama' => $request->input('agama'),
            'wa' => $request->input('wa'),
            'instagram' => $request->input('instagram')
        ]);

        return redirect()->route('profile')->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function progress()
    {
        $siswa = auth()->user()->siswa;

        $statusSiswa = $siswa->status_siswa_id ?? 0;
        $statusPendaftaran = $siswa->status_pendaftaran_id ?? 0;
        
        $seleksiVerified = $siswa->pembayaran()
            ->where('jenis_pembayaran', 'pendaftaran')
            ->where('status', 'verified')
            ->exists();
            
        $pelatihanVerified = $siswa->pembayaran()
            ->where('jenis_pembayaran', 'pelatihan')
            ->where('status', 'verified')
            ->exists();


        $isiDokumen = $siswa->dokumen()->exists();
        $sudahDaftarInterview = $siswa->pendaftaranInterview()->exists();
        $gagalInterviewPertama = $siswa->pendaftaranInterview()->latest()->first()?->status == 'tidak lolos';


        // Logic step status
        $steps = [
            [
                'title' => 'Register Akun',
                'description' => 'Siswa membuat akun awal untuk mengakses sistem pendaftaran.',
                'status' => 'done'
            ],
            [
                'title' => 'Melengkapi Data Diri',
                'description' => 'Melengkapi data pribadi, orang tua, dan dokumen yang dibutuhkan.',
                'status' => $isiDokumen ? 'done' : 'current'
            ],
            [
                'title' => 'Pembayaran Seleksi Pendaftaran',
                'description' => 'Melakukan pembayaran biaya seleksi untuk proses berikutnya.',
                'status' => $seleksiVerified ? 'done' : (!$isiDokumen ? 'upcoming' : 'current')
            ],
            [
                'title' => 'Seleksi Pendaftaran',
                'description' => 'Proses seleksi administrasi atau tes awal kelayakan.',
                'status' => $statusSiswa >= 4  ? 'done' : ($seleksiVerified  ? 'current' : 'upcoming')
            ],
            [
                'title' => 'Pembayaran Pelatihan',
                'description' => 'Melakukan pembayaran untuk pelatihan setelah seleksi.',
                'status' => $pelatihanVerified ? 'done' : ($statusPendaftaran >= 6 && $statusSiswa >=4 ? 'current' : 'upcoming')
            ],
            [
                'title' => 'Pelatihan',
                'description' => 'Mengikuti pelatihan yang disediakan lembaga.',
                'status' => $statusSiswa >= 5 ? 'done' : ($pelatihanVerified ? 'current' : 'upcoming')
            ],
            [
                'title' => 'Mendaftar Interview',
                'description' => 'Mengisi jadwal untuk mengikuti sesi interview akhir.',
                'status' => ($statusSiswa >= 6 && $sudahDaftarInterview && !$gagalInterviewPertama) ? 'done' : (($statusSiswa >= 6 && ($gagalInterviewPertama || !$sudahDaftarInterview)) ? 'current' : 'upcoming')
            ],
            [
                'title' => 'Interview',
                'description' => 'Menjalani sesi wawancara sebagai bagian dari penilaian akhir.',
                'status' => ($statusSiswa >= 8 && !$gagalInterviewPertama) ? 'done' : (($statusSiswa >= 6 && $sudahDaftarInterview && !$gagalInterviewPertama) ? 'current' : 'upcoming')
            ],
            [
                'title' => 'Selesai',
                'description' => 'Seluruh proses pendaftaran dan pelatihan telah selesai.',
                'status' => $statusSiswa === 8 ? 'done' : 'upcoming'
            ]
        ];
        return view('main.users.progress', compact(
            'steps',
        ));
    }
}
