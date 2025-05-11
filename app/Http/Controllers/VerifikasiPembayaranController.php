<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class VerifikasiPembayaranController extends Controller
{
    public function indexPendaftaran()
    {
        $data = Pembayaran::with('siswa.user')
            ->where('jenis_pembayaran', 'pendaftaran')
            ->where('status', 'pending')
            ->whereNotNull('siswa_id')
            ->get();
        // dd($data);
        return view('main.admin.verifikasi.pembayaran.pendaftaran.index', compact('data'));
    }

    public function editPendaftaran($id) {}
    public function updatePendaftaran(Request $request, $id) {}
}
