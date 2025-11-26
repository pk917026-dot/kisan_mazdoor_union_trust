<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller {

    public function index() {
        $events = Event::orderBy('id','DESC')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create() {
        return view('admin.events.create');
    }

    public function store(Request $request) {

        $slug = strtolower(str_replace(' ', '-', $request->title)) . '-' . time();

        $path = null;
        if($request->hasFile('banner')){
            $path = $request->file('banner')->store('uploads/events','public');
        }

        Event::create([
            'title' => $request->title,
            'slug' => $slug,
            'banner' => $path,
            'date' => $request->date,
            'location' => $request->location,
            'details' => $request->details,
            'status' => $request->status ? 1 : 0
        ]);

        return redirect()->route('admin.events')->with('success','Event Added');
    }

    public function delete($id) {
        Event::find($id)->delete();
        return back()->with('success','Event Deleted');
    }
}
