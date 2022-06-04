<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index(){
        $judul = 'Penjualan';
        $barang = DB::table('barang')->select('id','nama_barang','satuan','harga_jual','stock')->get();
        return view('admin.penjualan.list',compact('judul','barang'));
    }
    public function tambah($id){
        $barang = Barang::find($id);
        $penjualan = session()->get('penjualan',[]);
        if (isset($penjualan[$id])) {
            $penjualan[$id]['jumlah']++;
        } else {
            $penjualan[$id] = [
                'id' => $barang->id,
                'nama' => $barang->nama_barang,
                'jumlah' => 1,
                'harga' => $barang->harga_jual,
            ];
        }
        session()->put('penjualan',$penjualan);
        return redirect()->route('penjualan.index')->with('success','Barang ditambah ke keranjang');
    }
    public function update(Request $request){
        //dd($request);
        if ($request->id && $request->jumlah > 0) {
            $penjualan = session()->get('penjualan');
            $penjualan[$request->id]['jumlah'] = $request->jumlah;
            session()->put('penjualan',$penjualan);
            session()->flash('success', 'Barang Berhasil Update');
        } elseif ($request->jumlah < 1) {
            session()->flash('error', 'Barang Tidak boleh kurang dari 1');
        }
    }
    public function hapus(Request $request){
        if ($request->id) {
            $penjualan = session()->get('penjualan');
            if (isset($penjualan[$request->id])) {
                unset($penjualan[$request->id]);
                session()->put('penjualan',$penjualan);
            }
            session()->flash('success','Barang di hapus');
        }
    }
}
