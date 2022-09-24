<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\PembelianItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    public function index()
    {
        $judul = 'Pembelian';
        $supplier = DB::table('supplier')->get();
        $barang = DB::table('barang')->get();
        return view('admin.pembelian.list', compact('judul', 'supplier', 'barang'));
    }
    public function tambah(Request $request)
    {
        $harga = preg_replace('/[,]/', '', $request->harga);
        $barang = Barang::findOrFail($request->id);
        $pembelian = session()->get('pembelian', []);
        if (isset($pembelian[$request->id])) {
            $pembelian[$request->id]['jumlah']++;
        } else {
            $pembelian[$request->id] = [
                'id' => $barang->id,
                'nama' => $barang->nama_barang,
                'jumlah' => $request->jumlah,
                'harga' => $harga
            ];
        }
        session()->put('pembelian', $pembelian);
        return redirect()->route('pembelian.index')->with('success', 'Berhasil tambah barang');
    }
    public function hapus(Request $request)
    {
        if ($request->id) {
            $pembelian = session()->get('pembelian');
            if (isset($pembelian[$request->id])) {
                unset($pembelian[$request->id]);
                session()->put('pembelian', $pembelian);
            }
            session()->flash('success', 'Barang di hapus');
        }
    }
    public function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('barang')
                ->where('nama_barang', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="nav-item dropdown">';
            foreach ($data as $d) {
                $output .= '
                <li><a class="dropdown-item" href="">' . $d->nama_barang . '</a></li>';
            }
            $output .= '</ul>';
            return $output;
        }
    }
    public function update(Request $request)
    {
        //dd($request);
        if ($request->id && $request->jumlah > 0) {
            $pembelian = session()->get('pembelian');
            $pembelian[$request->id]['jumlah'] = $request->jumlah;
            session()->put('pembelian', $pembelian);
            session()->flash('success', 'Barang Berhasil Update');
        } elseif ($request->jumlah < 1) {
            session()->flash('error', 'Barang Tidak boleh kurang dari 1');
        }
    }
    public function simpan(Request $request){
        $total = preg_replace('/[,]/', '', $request->total);
        $transaksi = Pembelian::create([
            'id_supplier' => $request->supplier,
            'total' => $total,
            'id_user' => Auth::user()->id,
        ]);

        foreach (session('pembelian') as $p) {
            PembelianItem::create([
                'no_transaksi' => $transaksi,
                'id_barang' => $p['id'],
                'jumlah' => $p['jumlah'],
                'harga' => $p['jumlah']
            ]);

            //updatestock
            $data = Barang::find($p['id']);
            $stock = $data->stock + $p['jumlah'];
            Barang::where('id', $data->id)->update([
                'stock' => $stock
            ]);

            session()->forget('pembelian');
            return redirect()->route('pembelian.index')->with('success','Pembelian tersimpan');
        }   
    }
}
