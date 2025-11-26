<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DonationsController extends Controller
{
    public function index() { return view('admin.donations.index'); }
    public function create() { return view('admin.donations.create'); }
    public function store() { return redirect()->route('admin.donations.index')->with('success','Added'); }
    public function show($id) { return view('admin.donations.show', compact('id')); }
    public function edit($id) { return view('admin.donations.edit', compact('id')); }
    public function update() { return redirect()->route('admin.donations.index')->with('success','Updated'); }
    public function destroy($id) { return back()->with('success','Deleted'); }
}
