<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'page',
        'section_key',
        'title',
        'content',
        'button_text',
        'button_url',
        'icon',
        'image',
        'is_active',
        'sort_order',
    ];
}
