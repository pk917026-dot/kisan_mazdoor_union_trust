<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index() {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request) {
        $settings = Setting::first();

        if(!$settings){
            $settings = new Setting();
        }

        // Logo Upload
        if ($request->hasFile('site_logo')) {
            $logo = $request->file('site_logo')->store('uploads/logo', 'public');
            $settings->site_logo = $logo;
        }

        // Favicon Upload
        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon')->store('uploads/favicon', 'public');
            $settings->favicon = $favicon;
        }

        $settings->trust_name = $request->trust_name;
        $settings->contact_number = $request->contact_number;
        $settings->whatsapp = $request->whatsapp;
        $settings->email = $request->email;
        $settings->address = $request->address;
        $settings->header_color = $request->header_color;
        $settings->footer_color = $request->footer_color;
        $settings->menu_color = $request->menu_color;
        $settings->theme_color = $request->theme_color;
        $settings->facebook = $request->facebook;
        $settings->instagram = $request->instagram;
        $settings->youtube = $request->youtube;
        $settings->footer_text = $request->footer_text;

        $settings->save();

        return back()->with('success', 'Settings updated successfully');
    }
}
