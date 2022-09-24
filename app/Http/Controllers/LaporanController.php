<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $judul = 'Laporan';
        $pelanggan = DB::table('pelanggan')->select('id', 'nama_pelanggan')->get();
        return view('admin.laporan.list', compact('judul', 'pelanggan'));
    }
    public function harian(Request $request)
    {
        $judul = 'Laporan Harian';
        $date = Carbon::parse($request->date)->toDateTimeString();
        $data = Penjualan::whereDate('penjualan.created_at', $date)
            ->join('penjualan_item', 'penjualan.no_penjualan', '=', 'penjualan_item.no_penjualan')
            ->join('barang', 'barang.id', '=', 'penjualan_item.id_barang')
            ->select('penjualan.*', 'penjualan_item.*', 'barang.nama_barang')
            ->get();
        return view('admin.laporan.harian', compact('data', 'judul','date'));
    }

    public function periode(Request $request)
    {
        $judul = 'Laporan Periode';
        $start_date = Carbon::parse($request->start_date)->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->toDateString();
        $data = Penjualan::whereBetween('penjualan.created_at',[$start_date,$end_date])
            ->join('penjualan_item', 'penjualan.no_penjualan', '=', 'penjualan_item.no_penjualan')
            ->join('barang', 'barang.id', '=', 'penjualan_item.id_barang')
            ->select('penjualan.*', 'penjualan_item.*', 'barang.nama_barang')
            ->get();
        //dd($data);
        return view('admin.laporan.harian', compact('data', 'judul'));
    }
}
