<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ClaimsController extends Controller
{
    public function index() { return view('admin.claims.index'); }
    public function create() { return view('admin.claims.create'); }
    public function store() { return redirect()->route('admin.claims.index')->with('success','Added'); }
    public function show($id) { return view('admin.claims.show', compact('id')); }
    public function edit($id) { return view('admin.claims.edit', compact('id')); }
    public function update() { return redirect()->route('admin.claims.index')->with('success','Updated'); }
    public function destroy($id) { return back()->with('success','Deleted'); }
}
