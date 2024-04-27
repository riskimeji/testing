<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payment = Payment::all();
        return view('server.payment.index', compact('payment'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'number' => 'required'
        ]);
        Payment::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name' => $validatedData['name'],
                'number' => $validatedData['number'],
            ]
        );
        if ($request->id) {
            return redirect()->route('payment.index')->with('success', 'Success Update Payment!');
        } else {
            return redirect()->route('payment.index')->with('success', 'Success Menambah Payment!');
        }
    }
    // public function destroy($id)
    // {
    //     $payment = Payment::find($id);
    //     $payment->delete();

    //     return redirect()->route('payment.index')->with('success', 'Payment berhasil dihapus!');

    // }
}
