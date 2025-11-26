<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    protected $fillable = [
        'site_logo', 'favicon', 'trust_name', 'contact_number', 'whatsapp',
        'email', 'address', 'header_color', 'footer_color', 'menu_color',
        'theme_color', 'facebook', 'instagram', 'youtube', 'footer_text'
    ];
}
