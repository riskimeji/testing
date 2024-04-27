<?php

namespace App\Http\Controllers;

use App\Models\Rute;
use App\Models\Wahana;
use App\Models\Jadwal;
use App\Models\Transaksi;
use App\Models\Category;
use App\Models\Pemesanan;
use App\Models\Payment;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wahana = Wahana::orderBy('nama')->get();
        $jadwal = Jadwal::get();
        return view('client.index', compact('wahana', 'jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $huruf = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $kodePemesanan = strtoupper(substr(str_shuffle($huruf), 0, 7));

        $jumlah_tiket = $request->jumlah_tiket;
        $kode_tiket_array = [];

        for ($i = 0; $i < $jumlah_tiket; $i++) {
            $huruf_angka = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $kode_tiket = strtoupper(substr(str_shuffle($huruf_angka), 0, 7));
            $kode_tiket_array[] = $kode_tiket;
        }
        $kode_tiket_string = implode(',', $kode_tiket_array);

        $transaksi = Transaksi::create([
            'kode_transaksi' => $kodePemesanan,
            'wahana_id' => $request->wahana_id,
            'jadwal_id' => $request->jadwal_id,
            'user_id' => $user_id,
            'payment_id' => $request->payment_id,
            'total_bayar' => $request->total_harga,
            'tanggal_pesan' => now(),
            'jumlah_tiket' => $jumlah_tiket,
            'kode_tiket' => $kode_tiket_string,
            'status' => 'pending',
        ]);
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $transaksi->bukti_pembayaran = $buktiPembayaranPath;
            $transaksi->save();
        }

        return redirect()->route('history')->with('success', 'Pemesanan Tiket berhasil!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function mendetail(Request $request)
    {
        // dd($request->all());
        $data = $request;
        $wahana = Wahana::where('id', $request->wahana_id)->first();
        $jadwal = Jadwal::where('id', $request->jadwal_id)->first();
        $payment = Payment::all();
        $total_harga = $request->jumlah_tiket * $wahana->harga;
        $jumlah_tiket = $request->jumlah_tiket;
        return view('client.show', compact('wahana', 'jadwal', 'total_harga', 'jumlah_tiket', 'payment'));
    }
    public function show(Request $request, $id, $data)
    {
        // dd($request->all());
        // $data = Crypt::decrypt($data);
        // $category = Category::find($data['category']);
        // $rute = Rute::with('transportasi')->where('start', $data['start'])->where('end', $data['end'])->get();
        // if ($rute->count() > 0) {
        //     foreach ($rute as $val) {
        //         $pemesanan = Pemesanan::where('rute_id', $val->id)->where('waktu')->count();
        //         if ($val->transportasi) {
        //             $kursi = Transportasi::find($val->transportasi_id)->jumlah - $pemesanan;
        //             if ($val->transportasi->category_id == $category->id) {
        //                 $dataRute[] = [
        //                     'harga' => $val->harga,
        //                     'start' => $val->start,
        //                     'end' => $val->end,
        //                     'tujuan' => $val->tujuan,
        //                     'transportasi' => $val->transportasi->name,
        //                     'kode' => $val->transportasi->kode,
        //                     'kursi' => $kursi,
        //                     'waktu' => $data['waktu'],
        //                     'id' => $val->id,
        //                 ];
        //             }
        //         }
        //     }
        //     sort($dataRute);
        // } else {
        //     $dataRute = [];
        // }
        // $id = $category->name;
        return view('client.show', compact('id', 'dataRute'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Crypt::decrypt($id);
        $rute = Rute::find($data['id']);
        $transportasi = Transportasi::find($rute->transportasi_id);
        return view('client.kursi', compact('data', 'transportasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pesan($kursi, $data)
    {
        $d = Crypt::decrypt($data);
        $huruf = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $kodePemesanan = strtoupper(substr(str_shuffle($huruf), 0, 7));

        $rute = Rute::with('transportasi.category')->find($d['id']);

        $waktu = $d['waktu'] . " " . $rute->jam;

        Pemesanan::Create([
            'kode' => $kodePemesanan,
            'kursi' => $kursi,
            'waktu' => $waktu,
            'total' => $rute->harga,
            'rute_id' => $rute->id,
            'penumpang_id' => Auth::user()->id
        ]);

        return redirect('/')->with('success', 'Pemesanan Tiket ' . $rute->transportasi->category->name . ' Success!');
    }

    public function acc($id)
    {
        $transaksi = Transaksi::where('kode_transaksi', $id)->first();
        $transaksi->status = 'sukses';
        $transaksi->save();
        return redirect()->route('transaksi')->with('success', 'Transaksi Diterima!');

    }
    public function dec($id)
    {
        $transaksi = Transaksi::where('kode_transaksi', $id)->first();
        $transaksi->status = 'batal';
        $transaksi->save();
        return redirect()->route('transaksi')->with('success', 'Transaksi Ditolak!');
    }
}
