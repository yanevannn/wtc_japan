<?php

namespace App\Http\Controllers;

use App\Models\StatusPendaftaran;
use Illuminate\Http\Request;

class StatusPendaftaranController extends Controller
{
    public function index(){
        $data = StatusPendaftaran::all();
        return view('main.status_pendaftaran.index', compact('data'));
    }
}
