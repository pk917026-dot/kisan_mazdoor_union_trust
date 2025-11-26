<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\ExpenseCategory;

class ExpenseController extends Controller {

    public function index() {
        $categories = ExpenseCategory::all();
        $expenses = Expense::orderBy('date','DESC')->get();
        return view('admin.accounts.expense', compact('categories','expenses'));
    }

    public function store(Request $request) {

        Expense::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'voucher_no' => 'VOU'.time()
        ]);

        return back()->with('success','Expense Added Successfully');
    }

    public function delete($id) {
        Expense::find($id)->delete();
        return back()->with('success','Expense Deleted');
    }
}
