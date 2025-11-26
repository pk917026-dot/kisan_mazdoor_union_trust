<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

    protected $fillable = [
        'membership_id','name','father_name','mobile','whatsapp','email','dob',
        'address','district','state','pincode','photo','aadhaar','pan','status'
    ];
}
