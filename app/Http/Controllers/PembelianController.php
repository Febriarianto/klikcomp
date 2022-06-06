<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index()
    {
        $judul = 'Pembelian';
        $supplier = DB::table('supplier')->get();
        return view('admin.pembelian.list', compact('judul', 'supplier'));
    }
    public function tambah(Request $request)
    {
        $barang = Barang::findOrFail($request->id);
        $pembelian = session()->get('pembelian', []);
        if (isset($pembelian[$request->id])) {
            $pembelian[$request->id]['jumlah']++;
        } else {
            $pembelian[$request->id] = [
                'nama' => $request->nama,
                'jumlah' => $request->jumlah,
                'harga' => $request->harga
            ];
        }
        session()->put('pembelian', $pembelian);
        return redirect()->route('pembelian.index')->with('success', 'Berhasil tambah barang');
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
}
