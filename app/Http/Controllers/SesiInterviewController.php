<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\SesiInterview;
use Illuminate\Http\Request;

class SesiInterviewController extends Controller
{
    public function index()
    {
        $data = SesiInterview::all();
        return view('main.admin.sesi_interview.index', compact('data'));
    }

    public function create()
    {
        $data = Perusahaan::all();
        return view('main.admin.sesi_interview.create', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'perusahaan_id' => 'required|exists:tb_perusahaan,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
            'tempat'=> 'required'
        ]);
        SesiInterview::create($request->all());
        return redirect()->route('sesi-interview.index')->with('success', 'Sesi Interview berhasil dibuat.');
    }

    public function edit($id)
    {
        $data = SesiInterview::findOrFail($id);
        $perusahaan = Perusahaan::all();
        return view('main.admin.sesi_interview.edit', compact('data', 'perusahaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'perusahaan_id' => 'required|exists:tb_perusahaan,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
            'tempat' => 'required'
        ]);
        $sesiInterview = SesiInterview::findOrFail($id);
        $sesiInterview->update($request->all());
        return redirect()->route('sesi-interview.index')->with('success', 'Sesi Interview berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sesiInterview = SesiInterview::withCount('pendaftaranInterview')->findOrFail($id);

        if ($sesiInterview->pendaftaran_interview_count > 0) {
            return redirect()->route('sesi-interview.index')
                ->with('error', 'Sesi interview tidak dapat dihapus karena masih sudah ada pendaftar.');
        }

        $sesiInterview->delete();

        return redirect()->route('sesi-interview.index')
            ->with('success', 'Sesi interview berhasil dihapus.');
    }
}
