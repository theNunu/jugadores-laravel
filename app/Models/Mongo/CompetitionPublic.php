<?php

namespace App\Models\Mongo;

use MongoDB\Laravel\Eloquent\Model;

class CompetitionPublic extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'competitions';

    protected $primaryKey = 'competition_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'competition_id',
        'title',
        'description'
    ];
}
