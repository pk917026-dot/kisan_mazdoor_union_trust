<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index() {
        $photos = Gallery::orderBy('id','DESC')->get();
        return view('admin.gallery.index', compact('photos'));
    }

    public function store(Request $request) {

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('uploads/gallery','public');

            Gallery::create([
                'image' => $image,
                'title' => $request->title
            ]);
        }

        return back()->with('success','Photo Added to Gallery');
    }

    public function delete($id) {
        Gallery::find($id)->delete();
        return back()->with('success','Photo Deleted');
    }
}
