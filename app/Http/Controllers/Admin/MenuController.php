<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller {

    public function index() {
        $menus = Menu::orderBy('order')->get();
        return view('admin.menu.index', compact('menus'));
    }

    public function store(Request $request) {

        Menu::create([
            'title' => $request->title,
            'url' => $request->url,
            'parent_id' => $request->parent_id ?? 0,
            'order' => Menu::count() + 1,
            'status' => 1
        ]);

        return back()->with('success','Menu item added');
    }

    public function delete($id) {
        Menu::find($id)->delete();
        return back()->with('success','Menu deleted');
    }

    public function updateOrder(Request $request) {
        foreach ($request->order as $id => $order) {
            Menu::where('id', $id)->update(['order' => $order]);
        }
        return response()->json(['success'=>true]);
    }
}
