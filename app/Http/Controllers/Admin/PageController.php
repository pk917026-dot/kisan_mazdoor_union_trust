<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index() {
        $pages = Page::orderBy('id','DESC')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create() {
        return view('admin.pages.create');
    }

    public function store(Request $request) {

        $page = new Page();
        $page->title = $request->title;
        $page->slug = strtolower(str_replace(' ','-',$request->title));

        if ($request->hasFile('banner')) {
            $page->banner = $request->file('banner')->store('uploads/banners','public');
        }

        $page->content = $request->content;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->status = $request->status ? 1 : 0;

        $page->save();

        return redirect()->route('admin.pages')->with('success','Page Created Successfully');
    }

    public function edit($id) {
        $page = Page::find($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id) {

        $page = Page::find($id);

        $page->title = $request->title;
        $page->slug = strtolower(str_replace(' ','-',$request->title));

        if ($request->hasFile('banner')) {
            $page->banner = $request->file('banner')->store('uploads/banners','public');
        }

        $page->content = $request->content;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->status = $request->status ? 1 : 0;

        $page->save();

        return redirect()->route('admin.pages')->with('success','Page Updated');
    }

    public function delete($id) {
        Page::find($id)->delete();
        return back()->with('success','Page Deleted');
    }
}
