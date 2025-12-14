<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class Competition extends Model
{
    use HasUuids;
    protected $primaryKey = 'competition_id';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = ['title', 'description'];

    public function players()
    {
        return $this->belongsToMany(
            Player::class,
            'competition_player',
            'competition_id',
            'player_id'
        );
    }
}
