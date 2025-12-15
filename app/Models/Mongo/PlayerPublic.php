<?php

namespace App\Models\Mongo;

use MongoDB\Laravel\Eloquent\Model;

class PlayerPublic extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'players';

    protected $fillable = [
        '_id',
        'name',
        'age',
        'description',
        'competitions',
        // 'created_at',
        // 'updated_at',
    ];

    // public $timestamps = false;
    // protected $casts = [
    //     'competitions' => 'array',
    // ];
}
