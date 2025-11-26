<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\PageSection;

class HomeController extends Controller
{
    public function index()
    {
        // Hero section (top banner)
        $hero = PageSection::where('page', 'home')
            ->where('section_key', 'hero')
            ->where('is_active', true)
            ->first();

        // Slider slides
        $sliders = PageSection::where('page', 'home')
            ->where('section_key', 'slider')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Info blocks (sections नीचे वाले)
        $infoBlocks = PageSection::where('page', 'home')
            ->where('section_key', 'info_block')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Site settings
        $siteTitle  = SiteSetting::where('key', 'site_title')->value('value');
        $footerText = SiteSetting::where('key', 'footer_text')->value('value');

        return view('frontend.home', compact(
            'hero',
            'sliders',
            'infoBlocks',
            'siteTitle',
            'footerText'
        ));
    }
}
