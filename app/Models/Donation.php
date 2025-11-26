<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model {

    protected $fillable = [
        'receipt_no','name','mobile','amount','anonymous',
        'payment_mode','transaction_id'
    ];
}
