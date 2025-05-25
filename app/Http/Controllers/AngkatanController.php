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
            'nomor_angkatan' => 'required|unique:tb_angkatan,nomor_angkatan',
            'tahun' => 'required|integer|min:2020|max:2100',
            'status' => 'required|in:open,closed',
            'link_grup' => 'nullable|url|max:255',
        ]);
        if($request->status === 'open') {
            // Tutup (close) angkatan yang sebelumnya statusnya masih open
            Angkatan::where('status', 'open')->update(['status' => 'closed']);
        }

        $data = [
            'nomor_angkatan' => $request->input('nomor_angkatan'),
            'tahun' => $request->input('tahun'),
            'status' => $request->input('status'),
            'link_grup' => $request->input('link_grup'),
        ];
        Angkatan::create($data);
        return redirect()->route('angkatan.index')->with('success', 'Data Angkatan Berhasil Ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Angkatan $angkatan, String $id)
    {
        $data = Angkatan::findOrFail($id);
        return view('main.admin.angkatan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $angkatan = Angkatan::findOrFail($id);

        $request->validate([
            'nomor_angkatan' => 'required|unique:tb_angkatan,nomor_angkatan,' . $id,
            'tahun' => 'required|integer|min:2020|max:2100',
            'status' => 'required|in:open,closed',
            'link_grup' => 'required|url|max:255',
        ]);
        if ($request->status === 'open') {
            // Tutup (close) angkatan yang sebelumnya statusnya masih open
            Angkatan::where('status', 'open')
            ->where('id','!=', $angkatan->id)
            ->update(['status' => 'closed']);
        }
        // Jika status = closed
        if($request->status === 'closed') {
            // Cek apakah ada angkatan lain yang 'open', kecuali angkatan yang sedang diubah
            $angkatanOpenexist = Angkatan::where('status', 'open')
                ->where('id', '!=', $angkatan->id)
                ->exists();
            //jika tidak ada angaktan ipen tampilkan eroro
            if (!$angkatanOpenexist) {
                return redirect()->back()->with('error', 'Tidak ada angkatan yang sedang open, silakan ubah status angkatan lain terlebih dahulu.');
            }
        }


        $angkatan ->update( [
            'nomor_angkatan' => $request->input('nomor_angkatan'),
            'tahun' => $request->input('tahun'),
            'status' => $request->input('status'),
            'link_grup' => $request->input('link_grup'),
        ]);
        return redirect()->route('angkatan.index')->with('success', 'Data Angkatan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $angkatan = Angkatan::find($id);
        if (!$angkatan) {
            return redirect()->route('angkatan.index')->with('error', 'Data Angkatan Tidak Ditemukan');
        }

        // Cek apakah ada siswa yang berelasi dengan angkatan ini
        if ($angkatan->siswa()->exists()) {
            return redirect()->route('angkatan.index')->with('error', 'Data Angkatan tidak bisa dihapus karena terdapat data siswa.');
        }

        $angkatan->delete();
        return redirect()->route('angkatan.index')->with('success', 'Data Angkatan Berhasil Dihapus');
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