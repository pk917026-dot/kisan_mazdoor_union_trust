<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model {
    protected $fillable = [
        'membership_id','name','mobile','claim_type','amount',
        'document','details','status'
    ];
}
