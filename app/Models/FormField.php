<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $fillable = [
        'form_id', 'label', 'name', 'type', 'is_required',
        'options', 'validation_rules', 'order', 'is_active'
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_active' => 'boolean',
        'options' => 'array', // auto JSON cast
    ];

    public function form() {
        return $this->belongsTo(Form::class);
    }
}
