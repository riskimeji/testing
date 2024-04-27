<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wahana;
use App\Models\Jadwal;


class WahanaController extends Controller
{
    public function index()
    {
        $wahana = Wahana::get();
        return view('server.wahana.index', compact('wahana'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|integer',
            'status' => 'required|in:open,close',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $wahana = Wahana::find($request->id);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public');
        } else {
            $imagePath = $wahana->image;
        }
        Wahana::updateOrCreate(['id' => $request->id], [
            'nama' => $validatedData['nama'],
            'harga' => $validatedData['harga'],
            'stok' => $validatedData['stok'],
            'status' => $validatedData['status'],
            'deskripsi' => $validatedData['deskripsi'],
            'image' => $imagePath,
        ]);
        if ($request->id) {
            return redirect()->route('wahana.index')->with('success', 'Success Update Wahana!');
        } else {
            return redirect()->back()->with('success', 'Success Add Wahana!!');
        }
    }

    public function destroy($id)
    {
        $wahana = Wahana::find($id);
        $wahana->delete();

        return redirect()->route('wahana.index')->with('success', 'Wahana berhasil dihapus!');

    }

    public function edit($id)
    {
        $wahana = Wahana::find($id);
        return view('server.wahana.edit', compact('wahana'));
    }


    public function landing_page()
    {
        $wahana = Wahana::get();
        $jadwal = Jadwal::where('status', 'open')->get();
        return view('landing_page.home', compact('wahana', 'jadwal'));
    }

    public function kontak_kami()
    {
        return view('landing_page.kontak');
    }
    public function faq()
    {
        return view('landing_page.faq');
    }
    public function detail($id)
    {
        $wahana = Wahana::find($id);
        return view('landing_page.detail_wahana', compact('wahana'));
    }
}
