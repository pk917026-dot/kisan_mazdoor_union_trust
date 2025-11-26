<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\IncomeCategory;

class IncomeController extends Controller {

    public function index() {
        $categories = IncomeCategory::all();
        $incomes = Income::orderBy('date','DESC')->get();
        return view('admin.accounts.income', compact('categories','incomes'));
    }

    public function store(Request $request) {

        Income::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'receipt_no' => 'REC'.time()
        ]);

        return back()->with('success','Income Added Successfully');
    }

    public function delete($id) {
        Income::find($id)->delete();
        return back()->with('success','Income Deleted');
    }
}
