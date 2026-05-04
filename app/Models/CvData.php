<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvData extends Model
{
    protected $fillable = [
        'user_id',
        'slug',
        'template',
        'content',
        'is_paid',
    ];

    protected $casts = [
        'content' => 'array',
        'is_paid' => 'boolean',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
