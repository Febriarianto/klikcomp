<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $judul = "Supplier";
        $supplier = Supplier::all('*');
        return view('admin.supplier.list', compact('judul', 'supplier'));
    }
    public function store(Request $request)
    {
        Supplier::create([
            'nama_supplier' => $request->nama,
            'alamat' => $request->alamat,
            'no_tlp' => $request->nohp
        ]);

        return redirect()->route('supplier.index')->with('success', 'Berhasil di Tambah');
    }
    public function hapus(Request $request)
    {
        $hapus = Supplier::where('id', $request->id)->delete();
        return redirect()->route('supplier.index')->with('success', 'Berhasil di Hapus');
    }
    public function edit($ids)
    {
        $data = Supplier::where('id', $ids)->first();
        return response()->json($data, 200);
    }
    public function ubah(Request $request)
    {
        $ubah = Supplier::find($request->id);
        $ubah->nama_supplier = $request->nama;
        $ubah->alamat = $request->alamat;
        $ubah->no_tlp = $request->nohp;
        $ubah->update();
        return redirect()->route('supplier.index')->with('success', 'Berhasil di Update');
    }
}
