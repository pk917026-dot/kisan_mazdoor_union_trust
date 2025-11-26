<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller {

    public function index() {
        $news = News::orderBy('id','DESC')->get();
        return view('admin.news.index', compact('news'));
    }

    public function create() {
        return view('admin.news.create');
    }

    public function store(Request $request) {

        $slug = strtolower(str_replace(' ', '-', $request->title)) . '-' . time();

        $path = null;
        if($request->hasFile('image')){
            $path = $request->file('image')->store('uploads/news','public');
        }

        News::create([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $path,
            'short_description' => $request->short_description,
            'content' => $request->content,
            'status' => $request->status ? 1 : 0
        ]);

        return redirect()->route('admin.news')->with('success','News Added');
    }

    public function delete($id) {
        News::find($id)->delete();
        return back()->with('success','News Deleted');
    }
}
