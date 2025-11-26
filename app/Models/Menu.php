<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

    protected $fillable = [
        'title', 'url', 'parent_id', 'order', 'status'
    ];

    public function children() {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }
}
