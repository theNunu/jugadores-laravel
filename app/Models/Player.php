<?php

namespace App\Models;

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
}
