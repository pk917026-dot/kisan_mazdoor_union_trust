<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SahyogController extends Controller
{
    public function index() { return view('admin.sahyog.index'); }
    public function create() { return view('admin.sahyog.create'); }
    public function store(Request $r) { return redirect()->route('admin.sahyog.index')->with('success','Added'); }
    public function show($id) { return view('admin.sahyog.show', compact('id')); }
    public function edit($id) { return view('admin.sahyog.edit', compact('id')); }
    public function update(Request $r,$id) { return redirect()->route('admin.sahyog.index')->with('success','Updated'); }
    public function destroy($id) { return back()->with('success','Deleted'); }
}
