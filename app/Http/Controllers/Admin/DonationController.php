<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index() {
        $donations = Donation::orderBy('id','DESC')->get();
        return view('admin.donation.index', compact('donations'));
    }

    public function store(Request $request) {

        Donation::create([
            'receipt_no' => 'DON'.time(),
            'name' => $request->name,
            'mobile' => $request->mobile,
            'amount' => $request->amount,
            'anonymous' => $request->anonymous ? 1 : 0,
            'payment_mode' => $request->payment_mode,
            'transaction_id' => $request->transaction_id,
        ]);

        return back()->with('success','Donation Added Successfully');
    }

    public function delete($id) {
        Donation::find($id)->delete();
        return back()->with('success','Donation Deleted');
    }
}
