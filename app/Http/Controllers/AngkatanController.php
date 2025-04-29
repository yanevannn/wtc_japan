<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Angkatan::all();
        return view('main.angkatan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.angkatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        return view('main.angkatan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'angkatan' => 'required',
            'tahun' => 'required',
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
}
