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

    public function update (Request $request, $id)
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
}
