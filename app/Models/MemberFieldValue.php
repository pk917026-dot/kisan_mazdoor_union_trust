<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberFieldValue extends Model
{
    protected $fillable = [
        'member_id',
        'field_id',
        'value',
    ];

    public function member()
    {
        return $this->belongsTo(MemberRegistration::class, 'member_id');
    }

    public function field()
    {
        return $this->belongsTo(FormField::class, 'field_id');
    }
}
