<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Rute;
use App\Models\Wahana;
use App\Models\Transaksi;
use App\Models\Transportasi;
use App\Models\User;
use Illuminate\Http\Request;

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
        $wahana = Wahana::count();
        $transaksi = Transaksi::count();
        $pendapatan = Transaksi::where('status', 'sukses')->sum('total_bayar');
        $transportasi = Transportasi::count();
        $user = User::count();
        return view('server.home', compact('pendapatan', 'transportasi', 'user', 'wahana', 'transaksi'));
    }
}
