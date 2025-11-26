<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberRegistration extends Model
{
    protected $fillable = [
        'status',
    ];

    public function values()
    {
        return $this->hasMany(MemberFieldValue::class, 'member_id');
    }
}
