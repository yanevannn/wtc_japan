<?php

namespace App\Http\Controllers;

use App\Models\StatusSiswa;
use Illuminate\Http\Request;

class StatusSiswaController extends Controller
{
    public function index(){
        $data = StatusSiswa::all();
        return view('main.admin.status_siswa.index', compact('data'));
    }
}
