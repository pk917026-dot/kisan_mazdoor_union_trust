<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;
use App\Models\PageSection;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        // General settings
        SiteSetting::updateOrCreate(
            ['key' => 'site_title'],
            ['value' => 'Kisan Mazdoor Union Trust']
        );

        SiteSetting::updateOrCreate(
            ['key' => 'footer_text'],
            ['value' => '© ' . date('Y') . ' Kisan Mazdoor Union Trust. All rights reserved.']
        );

        // Home page hero section
        PageSection::updateOrCreate(
            ['page' => 'home', 'section_key' => 'hero'],
            [
                'title'       => 'Kisan Mazdoor Union Trust',
                'content'     => 'किसान और मजदूरों के अधिकारों के लिए एक समर्पित ट्रस्ट। सदस्य बनकर जुड़िए।',
                'button_text' => 'सदस्यता फॉर्म भरें',
                'button_url'  => route('member.register.form', [], false), // route name नीचे बनाएँगे
                'sort_order'  => 1,
                'is_active'   => true,
            ]
        );

        // Home – info block 1
        PageSection::updateOrCreate(
            ['page' => 'home', 'section_key' => 'info_block_1'],
            [
                'title'   => 'हमारा उद्देश्य',
                'content' => 'किसान और मजदूरों को सामाजिक और आर्थिक सुरक्षा प्रदान करना।',
                'sort_order' => 2,
                'is_active'  => true,
            ]
        );
    }
}
