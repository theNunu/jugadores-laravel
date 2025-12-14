<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Player extends Model
{
    use HasUuids;

    protected $primaryKey = 'player_id';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = ['name', 'age', 'description'];

    public function competitions()
    {
        return $this->belongsToMany(
            Competition::class,
            'competition_player',
            'player_id',
            'competition_id'
        );
    }
}
