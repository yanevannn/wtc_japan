<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\SesiInterview;
use App\Models\PendaftaranInterview;
use Illuminate\Support\Facades\Auth;

class PendaftaranInterviewController extends Controller
{
    public function index()
    {
        $data = PendaftaranInterview::where('siswa_id', auth()->user()->siswa->id)->orderByDesc('created_at')
            ->get();

        $jadwal = $data->first();

        return view('main.users.interview.index', compact('data', 'jadwal'));
    }

    public function create()
    {
        $siswa = Auth::user()->siswa;
        // Cek status_siswa_id
        if (!in_array($siswa->status_siswa_id, [6, 7])) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak diizinkan mendaftar interview.');
        }
        // Ambil pendaftaran terakhir (jika ada)
        $pendaftaranTerakhir = $siswa->pendaftaranInterview()->latest()->first();

        // Jika pernah mendaftar
        if ($pendaftaranTerakhir) {
            $status = $pendaftaranTerakhir->status;
            if ($status === 'pending') {
                return redirect()->route('dashboard')->with('error', 'Anda sudah mendaftar interview dan masih menunggu hasil.');
            }

            if ($status === 'lolos') {
                return redirect()->route('dashboard')->with('error', 'Anda sudah dinyatakan lolos interview dan tidak dapat mendaftar lagi.');
            }
        }

        // Ambil sesi interview yang masih tersedia kuota

        $today = Carbon::today();

        $data = Perusahaan::whereHas('sesiInterview', function ($query) use ($today) {
            $query->whereDate('tanggal', '>=', $today)
                ->withCount('pendaftaranInterview')
                ->havingRaw('kuota > pendaftaran_interview_count');
        })
            ->with(['sesiInterview' => function ($query) use ($today) {
                $query->whereDate('tanggal', '>=', $today)
                    ->withCount('pendaftaranInterview')
                    ->havingRaw('kuota > pendaftaran_interview_count');
            }])
            ->get();
        // dd($data);
        return view('main.users.interview.create', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sesi_interview_id' => 'required|exists:tb_sesi_interview,id',
        ]);

        $user = auth()->user()->siswa->id; // asumsikan siswa login pakai auth
        $sesiId = $request->sesi_interview_id;
        // Ambil sesi interview dengan count pendaftaran
        $sesi = SesiInterview::withCount('pendaftaranInterview')->findOrFail($sesiId);
        $sisaKuota = $sesi->kuota - $sesi->pendaftaran_interview_count;
        if ($sisaKuota <= 0) {
            return back()->withErrors('Kuota sesi interview sudah penuh.');
        }

        // Cek apakah siswa sudah daftar sesi ini sebelumnya
        $pendaftaran = PendaftaranInterview::where('siswa_id', $user)
            ->where('sesi_interview_id', $sesiId)
            ->first();

        if ($pendaftaran) {
            if ($pendaftaran->status === 'lolos') {
                return back()->withErrors('Anda sudah lolos pada sesi ini dan tidak bisa mendaftar ulang.');
            }
            // Jika tidak lolos, boleh daftar ulang
        }
        // Simpan pendaftaran baru
        PendaftaranInterview::create([
            'siswa_id' => $user,
            'sesi_interview_id' => $sesiId,
            'nilai' => null,
        ]);

        return redirect()->route('interview.index')->with('success', 'Pendaftaran interview berhasil.');
    }
}
