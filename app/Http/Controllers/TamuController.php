<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TamuController extends Controller
{
    public function index(Request $request)
    {
        $barang = Barang::select('id', 'nama_barang', 'keterangan')->get();
        $kategori = DB::table('kategori')->get();
        if ($request->ajax()) {
            return DataTables::of($barang)->addIndexColumn()
                ->addColumn('data_barang', function ($row) {
                    $image = DB::table('barang_detail')->join('barang', 'barang.id', '=', 'barang_detail.id_barang')->where('barang.id', $row->id)->first();
                    if ($image == "") {
                        $text = "null.png";
                    } else {
                        $text = $image->gambar;
                    }
                    $tampil =  '<div class="card">
                        <div class="row">
                            <div class="col-sm-2">
                                <img src="' . Storage::url('public/gambar_barang/') . $text . '" class="card-img-top" alt="...">
                            </div>
                            <div class="col-8 my-3">
                                <h5 class="card-title">' . $row->nama_barang . '</h5>
                                <p class="card-text">' . $row->keterangan . '</p>
                            </div>
                            <div class="col-2 mt-4">
                                <a href="' . route('tamu.detail', $row->id) . '" class="btn btn-primary">Detail</a>
                                <!-- <a href="" class="btn btn-success">Add Cart</a> -->
                            </div>
                        </div>
                    </div>';
                    return $tampil;
                })
                ->rawColumns(['data_barang'])
                ->make(true);
        }
        return view('welcome', compact('kategori'));
    }
    public function detail($id)
    {
        $barang = Barang::select('barang.*', 'barang_detail.gambar')->leftJoin('barang_detail', 'barang_detail.id_barang', '=', 'barang.id')->where('barang.id', $id)->first();
        $data_img = DB::table('barang_detail')->select('gambar')->where('id_barang', $id)->get();
        return view('detail', compact('barang', 'data_img'));
    }
    public function kategori($id)
    {
        $barang = Barang::select('barang.id', 'barang.nama_barang', 'barang.keterangan', 'barang_detail.gambar')
            ->leftJoin('barang_detail', 'barang_detail.id_barang', '=', 'barang.id')
            ->where('id_kategori', $id)
            ->groupBy('barang.id')
            ->get();
        $kategori = DB::table('kategori')->get();
        return view('filter', compact('kategori', 'barang'));
    }
}
