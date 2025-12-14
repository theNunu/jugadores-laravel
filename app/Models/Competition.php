<?php

namespace App\Models;

use App\Models\Mongo\CompetitionPublic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Competition extends Model
{
    protected $hidden = ['pivot']; //tiene que colocarse en este modelo para que no aparezca en la relacion many to many y vicecversa segun el modelo que llames en el service

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
        )->withPivot('id');
    }

    protected static function booted()
    {
        static::created(function ($competition) {
            CompetitionPublic::create([
                '_id'            => $competition->competition_id, // 👈 IMPORTANTE
                // 'competition_id' => $competition->competition_id,
                'title'          => $competition->title,
                'description'    => $competition->description,
            ]);
        });

        static::updated(function ($competition) {
            CompetitionPublic::where('competition_id', $competition->competition_id)
                ->update([
                    'title'       => $competition->title,
                    'description' => $competition->description,
                ]);
        });

        static::deleted(function ($competition) {
            CompetitionPublic::where('competition_id', $competition->competition_id)
                ->delete();
        });
    }
}
