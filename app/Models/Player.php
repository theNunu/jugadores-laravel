<?php

namespace App\Models;

use App\Models\Mongo\PlayerPublic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Player extends Model
{
    protected $hidden = ['pivot']; //tiene que colocarse en este modelo para que no aparezca en la relacion many to many y vicecversa segun el modelo que llames en el service
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
        )->withPivot('id'); //->withPivot('id'); añdido para que aparezca el id de la tabla pivote en el get all
    }
    //TODA LA CONEXION CON MONGOOOOOO

    // protected static function booted()
    // {
    //     static::saved(function ($player) {
    //         $player->syncToMongo();
    //     });

    //     static::deleted(function ($player) {
    //         PlayerPublic::where('_id', $player->player_id)->delete();
    //     });
    // }

    // public function syncToMongo()
    // {
    //     PlayerPublic::updateOrCreate(
    //         ['_id' => $this->player_id],
    //         [
    //             'name'         => $this->name,
    //             'age'          => $this->age,
    //             'description'  => $this->description,
    //             'competitions' => $this->competitions()
    //                 ->pluck('competitions.competition_id')
    //                 ->toArray(),
    //             'created_at'   => $this->created_at,
    //             'updated_at'   => now(),
    //         ]
    //     );
    // }
}
