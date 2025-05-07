<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use Illuminate\Http\Request;

class GelombangController extends Controller
{
   public function index()
   {
       $data = Gelombang::all();
       return view('main.admin.gelombang_pendaftaran.index', compact('data'));
   }

   public function create()
   {
       return view('main.admin.gelombang_pendaftaran.create');
   }

   public function store(Request $request)
   {
       $request->validate([
           'nama' => 'required|string|max:255',
           'tanggal_mulai' => 'required|date',
           'tanggal_selesai' => 'required|date|after:tanggal_mulai',
       ]);

       Gelombang::create($request->all());

       return redirect()->route('gelombang.index')->with('success', 'Gelombang created successfully.');
   }

   public function edit($id)
   {
       $gelombang = Gelombang::findOrFail($id);
       return view('main.admin.gelombang_pendaftaran.edit', compact('gelombang'));
   }

   public function update(Request $request, $id)
   {
       $request->validate([
           'nama' => 'required|string|max:255',
           'tanggal_mulai' => 'required|date',
           'tanggal_selesai' => 'required|date|after:tanggal_mulai',
       ]);

       $gelombang = Gelombang::findOrFail($id);
       $gelombang->update($request->all());

       return redirect()->route('gelombang.index')->with('success', 'Gelombang updated successfully.');
   }

   public function destroy($id)
   {
       $gelombang = Gelombang::findOrFail($id);
       $gelombang->delete();

       return redirect()->route('gelombang.index')->with('success', 'Gelombang deleted successfully.');
   }
}
