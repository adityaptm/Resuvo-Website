<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'cv_data_id',
        'external_id',
        'amount',
        'status',
        'payment_method',
    ];
}
