<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $judul = 'Barang';
        $barang = DB::table('barang')->select('id', 'nama_barang', 'satuan', 'stock', DB::raw('format(harga_beli,0) as harga_beli, format(harga_jual,0) as harga_jual'))
            ->get();
        if ($request->ajax()) {
            return DataTables::of($barang)->addIndexColumn()
                ->addColumn('kategori', function ($row) {
                    $kategori = Kategori::select('nama_kategori')->join('barang', 'barang.id_kategori', '=', 'kategori.id')->where('barang.id', $row->id)->get();
                    $text = "";
                    foreach ($kategori as $k) {
                        $text .= $k->nama_kategori;
                    }
                    return $text;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('barang.edit', $row->id) . '" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                    <button class="btn btn-danger passingHAPUS" data-toggle="modal" data-target="#modal-hapus" data-id="' . $row->id . '" data-kt="' . $row->nama_barang . '"><i class="fas fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action', 'kategori'])
                ->make(true);
        }
        $kategori = DB::table('kategori')->get();
        $supplier = DB::table('supplier')->get();
        return view('admin.barang.list', compact('judul', 'barang', 'kategori', 'supplier'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'gambar' => 'required',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasfile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $name = $image->hashName();
                $image->storeAs('public/gambar_barang', $name);
                $name_image[] = $name;
            }
        }

        $databeli = preg_replace('/[,]/', '', $request->hargabeli);
        $datajual = preg_replace('/[,]/', '', $request->hargajual);
        //dd($databeli, $datajual);
        $get_barang = Barang::create(
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
        foreach ($name_image as $i) {
            DB::table('barang_detail')->insert(
                [
                    'id_barang' => $get_barang->id,
                    'gambar' => $i

                ]
            );
        }

        return redirect()->route('barang.index')->with('success', 'Berhasil di Tambah');
    }
    public function destroy(Barang $barang)
    {
        $image = DB::table('barang_detail')->where('id_barang', $barang->id)->get();
        foreach ($image as $i) {
            Storage::delete('public/gambar_barang/' . $i->gambar);
        }
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Berhasil di Hapus');
    }

    public function hapus(Request $request)
    {
        $query = DB::table('barang_detail')->where('id', $request->id);
        $image = $query->first();
        Storage::delete('public/gambar_barang/' . $image->gambar);
        $query->delete();
        return redirect()->back()->with('success', 'gambar berhasil di hapus');
    }

    public function edit(Barang $barang)
    {
        $judul = "Edit Barang";
        $kategori = DB::table('kategori')->get();
        $supplier = DB::table('supplier')->get();
        $image = DB::table('barang_detail')->select('id', 'gambar')->where('id_barang', $barang->id)->get();
        return view('admin.barang.edit', compact('barang', 'kategori', 'supplier', 'image', 'judul'));
    }

    public function update(Request $request, Barang $barang)
    {

        if ($request->hasfile('gambar')) {
            # code...
            $this->validate($request, [
                'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            foreach ($request->file('gambar') as $image) {
                $name = $image->hashName();
                $image->storeAs('public/gambar_barang', $name);
                $name_image[] = $name;
            }

            $databeli = preg_replace('/[,]/', '', $request->hargabeli);
            $datajual = preg_replace('/[,]/', '', $request->hargajual);
            //dd($databeli, $datajual);
            $barang->update(
                [
                    'nama_barang' => $request->nama,
                    'satuan' => $request->satuan,
                    'keterangan' => $request->keterangan,
                    'barcode' => $request->barcode,
                    'harga_jual' => $datajual,
                    'harga_beli' => $databeli,
                    'id_kategori' => $request->kategori,
                    'id_supplier' => $request->supplier,
                ]
            );
            foreach ($name_image as $i) {
                DB::table('barang_detail')->insert(
                    [
                        'id_barang' => $barang->id,
                        'gambar' => $i

                    ]
                );
            }
        } else {
            $databeli = preg_replace('/[,]/', '', $request->hargabeli);
            $datajual = preg_replace('/[,]/', '', $request->hargajual);
            //dd($databeli, $datajual);
            $barang->update(
                [
                    'nama_barang' => $request->nama,
                    'satuan' => $request->satuan,
                    'keterangan' => $request->keterangan,
                    'barcode' => $request->barcode,
                    'harga_jual' => $datajual,
                    'harga_beli' => $databeli,
                    'id_kategori' => $request->kategori,
                    'id_supplier' => $request->supplier,
                ]
            );
        }
        return redirect()->route('barang.index')->with('success', 'Berhasil di Update');
    }
}
