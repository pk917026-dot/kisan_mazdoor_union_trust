<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model {
    protected $fillable = [
        'welcome_title','welcome_description','marquee_text','video_url',
        'about_title','about_description',
        'show_gallery','show_notice','show_video','show_about','show_slider'
    ];
}
