<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentCategory;

class DocumentController extends Controller {

    public function index() {
        $categories = DocumentCategory::all();
        $documents = Document::orderBy('id','DESC')->get();
        return view('admin.documents.index', compact('documents','categories'));
    }

    public function store(Request $request) {

        $path = $request->file('file')->store('uploads/documents','public');

        Document::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'file' => $path,
            'description' => $request->description
        ]);

        return back()->with('success','Document Uploaded');
    }

    public function delete($id) {
        Document::find($id)->delete();
        return back()->with('success','Document Deleted');
    }
}
