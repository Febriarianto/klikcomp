<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function adminHome()
    {
        $judul = "Klik-Comp";
        $barang = DB::table('barang')->select(DB::raw('COUNT(id) as id'))->first();
        $pelanggan = DB::table('pelanggan')->select(DB::raw('COUNT(id) as id'))->first();
        return view('admin.index', compact('judul', 'barang', 'pelanggan'));
    }
}
