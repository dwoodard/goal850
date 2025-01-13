<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = 'entries';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'site',
        'origin_id',
        'published',
        'slug',
        'uri',
        'date',
        'order',
        'collection',
        'blueprint',
        'data',
    ];

    protected $casts = [
        'id' => 'string',
        'origin_id' => 'string',
        'published' => 'boolean',
        'data' => 'array',
    ];
}
