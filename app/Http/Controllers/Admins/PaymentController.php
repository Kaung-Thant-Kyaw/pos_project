<?php

namespace App\Http\Controllers\Admins;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    // Payment View
    public function index()
    {
        $payments = Payment::latest()->paginate(5);
        return view('admins.payments.index', compact('payments'));
    }

    // Payment Store to Payment Table
    public function store(Request $request)
    {
        $this->paymentValidation($request);
        $data = $this->paymentRequestData($request);
        Payment::create($data);
        Alert::success('Payment Create', 'Payment Created Successfully');
        return back();
    }

    // Payment Edit Page
    public function edit($id)
    {
        $payment = Payment::find($id);
        return view('admins.payments.edit', compact('payment'));
    }

    // Update Payment
    public function update($id, Request $request)
    {
        $payment = Payment::find($id);
        $this->paymentValidation($request);
        $payment->update([
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'type' => $request->type,
        ]);
        Alert::success('Payment Update', 'Payment Updated Successfully');

        return to_route('payment.index');
    }

    // Delete Payment
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        Alert::success('Payment Delete', 'Payment Deleted Successfully');
        return to_route('payment.index');
    }

    // Payment Request Data
    private function paymentRequestData(Request $request)
    {
        return [
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'type' => $request->type,
        ];
    }

    // Payment Validation
    private function paymentValidation(Request $request)
    {
        $request->validate([
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:50',
            'type' => 'required|string|max:20',
        ]);
    }
}
