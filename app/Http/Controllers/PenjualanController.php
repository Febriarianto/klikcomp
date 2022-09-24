<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\PenjualanItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $judul = 'Penjualan';
        if (Auth::user()->type == 'admin') {
            $data = Penjualan::join('pelanggan', 'penjualan.id_pelanggan', '=', 'pelanggan.id')
            ->get();
            return view('admin.penjualan.list', compact('judul', 'data'));
        } else {
            $pelanggan = DB::table('pelanggan')->get();
            $barang = DB::table('barang')->select('id', 'nama_barang', 'satuan', 'harga_jual', 'stock')->get();
            return view('admin.penjualan.transaksi', compact('judul', 'barang', 'pelanggan'));
            
        }
    }
    public function tambah(Request $request)
    {
        if ($request->id == null) {
            return redirect()->route('penjualan.transaksi')->with('error', 'kode barang harus di isi');
        } else {
            $barang = Barang::find($request->id);
            $jumlah = 1;
            if (isset($request->jumlah)) {
                $jumlah = $request->jumlah;
            }

            if ($barang->stock < $jumlah) {
                return redirect()->route('penjualan.transaksi')->with('error', 'Stok ' . $barang->stock);
            } else {
                $penjualan = session()->get('penjualan', []);
                if (isset($penjualan[$request->id])) {
                    $penjualan[$request->id]['jumlah']++;
                } else {
                    $penjualan[$request->id] = [
                        'id' => $barang->id,
                        'nama' => $barang->nama_barang,
                        'jumlah' => $jumlah,
                        'harga' => $barang->harga_jual,
                    ];
                }
                session()->put('penjualan', $penjualan);
                return redirect()->route('penjualan.transaksi')->with('success', 'Barang ditambah ke keranjang');
            }
        }
    }
    public function update(Request $request)
    {
        //dd($request);
        if ($request->id && $request->jumlah > 0) {
            $penjualan = session()->get('penjualan');
            $penjualan[$request->id]['jumlah'] = $request->jumlah;
            session()->put('penjualan', $penjualan);
            session()->flash('success', 'Barang Berhasil Update');
        } elseif ($request->jumlah < 1) {
            session()->flash('error', 'Barang Tidak boleh kurang dari 1');
        }
    }
    public function hapus(Request $request)
    {
        if ($request->id) {
            $penjualan = session()->get('penjualan');
            if (isset($penjualan[$request->id])) {
                unset($penjualan[$request->id]);
                session()->put('penjualan', $penjualan);
            }
            session()->flash('success', 'Barang di hapus');
        }
    }
    public function simpan(Request $request)
    {
        $uangbayar = preg_replace('/[,]/', '', $request->uang_bayar);
        $kembalian = preg_replace('/[,]/', '', $request->kembalian);
        $diskon = preg_replace('/[,]/', '', $request->diskon);
        $total = preg_replace('/[,]/', '', $request->total);
        $transaksi = Penjualan::create([
            'id_pelanggan' => $request->pelanggan,
            'uang_bayar' => $uangbayar,
            'diskon' => $diskon,
            'total' => $total,
            'kembalian' => $kembalian,
            'keterangan' => $request->keterangan,
            'id_user' => Auth::user()->id
        ]);
        
        foreach (session('penjualan') as $p) {
            PenjualanItem::create([
                'no_penjualan' => $transaksi->id,
                'id_barang' => $p['id'],
                'jumlah' => $p['jumlah'],
                'harga_jual' => $p['harga'],
            ]);

            //update stock
            $data = Barang::find($p['id']);
            $stock = $data->stock - $p['jumlah'];
            Barang::where('id', $data->id)->update([
                'stock' => $stock
            ]);
        }

        session()->forget('penjualan');
        $id = $transaksi->id;
        $judul = "Print";
        return view('admin.penjualan.print',compact('judul','id'))->with('success', 'Data Transaksi berhasil');
    }
    public function show($id){
        $data_transaksi = Penjualan::where('penjualan.no_penjualan', $id)
        ->join('pelanggan', 'penjualan.id_pelanggan', '=', 'pelanggan.id')
        ->first();
        $data_item = Penjualan::where('penjualan.no_penjualan', $id)
        ->join('penjualan_item', 'penjualan.no_penjualan', '=', 'penjualan_item.no_penjualan')
        ->join('barang', 'barang.id', '=', 'penjualan_item.id_barang')
        ->select('penjualan.*', 'penjualan_item.*', 'barang.nama_barang')
        ->get();
       return view('admin.penjualan.preview',compact('data_transaksi','data_item'));
    }
    public function transaksi(){
        $judul = "Penjualan";
        $pelanggan = DB::table('pelanggan')->get();
        $barang = DB::table('barang')->select('id', 'nama_barang', 'satuan', 'harga_jual', 'stock')->get();
        return view('admin.penjualan.transaksi', compact('judul', 'barang', 'pelanggan'));
    }
}
