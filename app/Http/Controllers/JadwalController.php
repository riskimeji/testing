<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all();
        return view('server.jadwal.index', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'status' => 'required'
        ]);
        Jadwal::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'date' => $validatedData['date'],
                'status' => $validatedData['status'],
            ]
        );
        if ($request->id) {
            return redirect()->route('jadwal.index')->with('success', 'Success Update Jadwal!');
        } else {
            return redirect()->route('jadwal.index')->with('success', 'Success Menambah Jadwal!');
        }
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}
