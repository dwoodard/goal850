<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebHook extends Model
{
    protected $fillable = [
        'event_type',
        'payload',
        'processed_at',
        'created_at'
    ];
    
    protected $casts = [
        'payload' => 'array',
        'processed_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}
