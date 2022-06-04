<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganControler extends Controller
{
    public function index()
    {
        $judul = 'Pelanggan';
        $pelanggan = Pelanggan::all('*');
        return view('admin.pelanggan.list', compact('judul', 'pelanggan'));
    }
    public function store(Request $request)
    {
        Pelanggan::create([
            'nama_pelanggan' => $request->nama,
            'alamat' => $request->alamat,
            'no_tlp' => $request->nohp
        ]);
        return redirect()->route('pelanggan.index')->with('success', 'Berhasil di Tambah');
    }
    public function edit($id)
    {
        $data = Pelanggan::where('id', $id)->first();
        return response()->json($data, 200);
    }
    public function ubah(Request $request)
    {
        $ubah = Pelanggan::find($request->id);
        $ubah->nama_pelanggan = $request->nama;
        $ubah->alamat = $request->alamat;
        $ubah->no_tlp = $request->nohp;
        $ubah->update();

        return redirect()->route('pelanggan.index')->with('success', 'Berhasil di Update');
    }
    public function hapus(Request $request)
    {
        $hapus = Pelanggan::where('id', $request->id)->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Berhasil di Hapus');
    }
}
