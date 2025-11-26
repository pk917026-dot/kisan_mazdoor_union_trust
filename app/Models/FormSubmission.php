<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = [
        'form_id', 'data', 'submitted_by_ip'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function form() {
        return $this->belongsTo(Form::class);
    }
}
