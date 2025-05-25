<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranInterview;
use Illuminate\Http\Request;

class NilaiInterviewController extends Controller
{
    public function index(){
        $data = PendaftaranInterview::where('status', 'pending')->get();
        return view('main.admin.interview.index', compact('data'));
    }

    public function store(Request $request){
        $request->validate([
            'id' => 'required|exists:tb_pendaftaran_interview,id',
            'nilai' => 'required|numeric|max:100',
            'status' => 'required|in:lolos,tidak lolos',
        ],[
            'nilai.required' => 'Nilai harus diisi',
            'nilai.numeric' => 'Nilai harus berupa angka',
            'nilai.max' => 'Nilai maksimal adalah 100',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status harus salah satu dari lolos atau tidak lolos',
        ]);
        if ($request->status == 'lolos') {
            $request->validate([
                'nilai' => 'required|numeric|min:60',
            ], [
                'nilai.min' => 'Nilai minimal untuk lolos adalah 60',
            ]);
        }
        if ($request->status == 'tidak lolos') {
            $request->validate([
                'nilai' => 'required|numeric|max:59',
            ], [
                'nilai.max' => 'Nilai maksimal untuk tidak lolos adalah 59',
            ]);
        }
        $pendaftaran = PendaftaranInterview::findOrFail($request->id);
        $pendaftaran->nilai = $request->nilai;
        $pendaftaran->status = $request->status;
        $pendaftaran->save();
        $siswa_id = $pendaftaran->siswa_id;
        if ($pendaftaran->status == 'lolos') {
            $siswa = $pendaftaran->siswa;
            $siswa->status_siswa_id = 8;
            $siswa->save();
        } else {
            $siswa = $pendaftaran->siswa;
            $siswa->status_siswa_id = 7;
            $siswa->save();
        }
        return redirect()->route('hasil-interview.index')->with('success', 'Nilai berhasil disimpan');
    }
}
