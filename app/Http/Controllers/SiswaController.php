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
        return view('main.siswa.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|numeric|digits:16',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'golongan_darah' => 'required|string|in:A,B,AB,O',
            'agama' => 'required|string|max:50',
            'wa' => 'required',
            'instagram' => 'nullable|string|max:50',
        ]);

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
            'instagram' => $request->input('instagram'),

            //
            'user_id' => Auth::id(),
            'status_pendaftaran_id' => 1,
            'status_siswa_id' => 1

        ];

        Siswa::create($data);
        return redirect()->route('profile')->with('success', 'Data anda berhasil disimpan.');
    }
}
