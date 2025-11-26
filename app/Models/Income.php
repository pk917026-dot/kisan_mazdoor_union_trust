<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model {

    protected $fillable = [
        'category_id','title','amount','date','receipt_no'
    ];

    public function category() {
        return $this->belongsTo(IncomeCategory::class);
    }
}
