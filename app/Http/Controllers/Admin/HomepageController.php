<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomepageSetting;
use App\Models\Slider;

class HomepageController extends Controller {

    public function index() {
        $settings = HomepageSetting::first();
        $sliders = Slider::orderBy('order')->get();
        return view('admin.homepage.index', compact('settings', 'sliders'));
    }

    public function saveSettings(Request $request) {

        $settings = HomepageSetting::first() ?? new HomepageSetting();

        $settings->welcome_title = $request->welcome_title;
        $settings->welcome_description = $request->welcome_description;
        $settings->marquee_text = $request->marquee_text;
        $settings->video_url = $request->video_url;
        $settings->about_title = $request->about_title;
        $settings->about_description = $request->about_description;

        $settings->show_gallery = $request->show_gallery ? 1 : 0;
        $settings->show_notice = $request->show_notice ? 1 : 0;
        $settings->show_video = $request->show_video ? 1 : 0;
        $settings->show_about = $request->show_about ? 1 : 0;
        $settings->show_slider = $request->show_slider ? 1 : 0;

        $settings->save();
        return back()->with('success','Home Page Updated');
    }

    public function uploadSlider(Request $request) {
        $image = $request->file('image')->store('uploads/sliders', 'public');

        Slider::create([
            'image' => $image,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'order' => Slider::count() + 1
        ]);

        return back()->with('success','Slider Added');
    }

    public function deleteSlider($id) {
        Slider::find($id)->delete();
        return back()->with('success','Slider Removed');
    }
}
