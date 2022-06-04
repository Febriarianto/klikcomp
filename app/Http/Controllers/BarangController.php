<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $judul = 'Barang';
        $barang = DB::table('barang')
            ->join('kategori', 'barang.id_kategori', '=', 'kategori.id')
            ->select(
                'barang.id',
                'barang.nama_barang',
                'barang.satuan',
                'Kategori.nama_kategori',
                'barang.stock',
                'barang.harga_beli as hargabeli',
                'barang.harga_jual as hargajual'
            )
            ->get();
        $kategori = DB::table('kategori')->get();
        $supplier = DB::table('supplier')->get();
        return view('admin.barang.list', compact('judul', 'barang', 'kategori', 'supplier'));
    }
    public function store(Request $request)
    {
        $databeli = preg_replace('/[,]/', '', $request->hargabeli);
        $datajual = preg_replace('/[,]/', '', $request->hargajual);
        dd($databeli, $datajual);
        DB::table('barang')->insert(
            [
                'nama_barang' => $request->nama,
                'satuan' => $request->satuan,
                'keterangan' => $request->keterangan,
                'barcode' => $request->barcode,
                'harga_jual' => $datajual,
                'harga_beli' => $databeli,
                'stock' => 0,
                'id_kategori' => $request->kategori,
                'id_supplier' => $request->supplier,
            ]
        );

        return redirect()->route('barang.index')->with('success', 'Berhasil di Tambah');
    }
    public function hapus(Request $request)
    {
        DB::table('barang')->where('id', $request->id)->delete();

        return redirect()->route('barang.index')->with('success', 'Berhasil di Hapus');
    }
    public function edit($id)
    {
        $data = DB::table('barang')->where('id', $id)->first();
        return response()->json($data, 200);
    }
}
