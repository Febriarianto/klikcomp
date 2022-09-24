<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
     public function __construct()
    {
        $this->middleware('user-access:admin');
    }
    public function index()
    {
        $judul = 'Kategori';
        $kategori = Kategori::all('*');
        return view('admin.kategori.list', compact('judul', 'kategori'));
    }
    public function store(Request $request)
    {
        Kategori::create([
            'nama_kategori' => $request->kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Berhasil Tambah Baru');
    }
    public function ubah(Request $request)
    {

        $ubah = Kategori::find($request->id);
        $ubah->nama_kategori = $request->kategori;
        $ubah->update();

        return redirect()->route('kategori.index')->with('success', 'Berhasil ! Kategori diUpdate');
    }
    public function hapus(Request $request)
    {
        $hapus = Kategori::where('id', $request->id)->delete();
        return redirect()->route('kategori.index')->with('success', 'Berhasil ! diHapus');
    }
}
