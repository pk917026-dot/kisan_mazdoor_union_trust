<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentCategory;

class DocumentCategoryController extends Controller {

    public function index() {
        $categories = DocumentCategory::all();
        return view('admin.documents.categories', compact('categories'));
    }

    public function store(Request $request) {
        DocumentCategory::create(['name' => $request->name]);
        return back()->with('success','Category Added');
    }

    public function delete($id) {
        DocumentCategory::find($id)->delete();
        return back()->with('success','Category Deleted');
    }
}
