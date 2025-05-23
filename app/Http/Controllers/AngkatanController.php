<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Angkatan::withCount('siswa as jumlah_pendaftar')->latest()->get();
        return view('main.admin.angkatan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.admin.angkatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'angkatan' => 'required|unique:tb_angkatan,angkatan',
            'tahun' => 'required|integer|min:2020|max:2100',
        ]);
        $data = [
            'angkatan' => $request->input('angkatan'),
            'tahun' => $request->input('tahun'),
        ];
        Angkatan::create($data);
        return redirect()->route('angkatan.index')->with('success', 'Data Angkatan Berhasil Ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Angkatan $angkatan, String $id)
    {
        $data = Angkatan::find($id);
        return view('main.admin.angkatan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'angkatan' => 'required|unique:tb_angkatan,angkatan,' . $id,
            'tahun' => 'required|integer|min:2020|max:2100',
        ]);
        $data = [
            'angkatan' => $request->input('angkatan'),
            'tahun' => $request->input('tahun'),
        ];
        Angkatan::where('id', $id)->update($data);
        return redirect()->route('angkatan.index')->with('success', 'Data Angkatan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $angkatan = Angkatan::find($id);
        if ($angkatan) {
            $angkatan->delete();
            return redirect()->route('angkatan.index')->with('success', 'Data Angkatan Berhasil Dihapus');
        } else {
            return redirect()->route('angkatan.index')->with('error', 'Data Angkatan Tidak Ditemukan');
        }
    }

    public function indexData($id)
    {
        $angkatan = Angkatan::find($id);
        $data = Siswa::with([
            'user:id,fname,lname,email',
            'statusPendaftaran',
            'angkatan' // Tambahkan eager load angkatan di sini
        ])
            ->where('angkatan_id', $id)
            ->get();
        
        return view('main.admin.angkatan.data_siswa.index', compact('data', 'angkatan'));
    }
}