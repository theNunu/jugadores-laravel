<?php

namespace App\Services;

use App\Models\Competition;
use App\Models\Mongo\CompetitionPublic;
use App\Models\Mongo\PlayerPublic;
use App\Models\Player;
use App\Repositories\PlayerRepository;

class PublicService
{
    protected PlayerRepository $playerRepository;
    public function __construct(PlayerRepository  $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function list() //LISTAR players con sus competiciones (Mongo)
    {
        $players = PlayerPublic::all();

        return $players->map(function ($player) {

            // 🔐 NORMALIZACIÓN
            $competitionIds = [];

            if (is_array($player->competitions)) {
                $competitionIds = $player->competitions;
            } elseif (is_string($player->competitions)) {
                $competitionIds = [$player->competitions];
            }

            $competitions = empty($competitionIds)
                ? collect()
                : CompetitionPublic::whereIn('_id', $competitionIds)->get();

            return [
                'player_id'   => $player->_id,
                'name'        => $player->name,
                'age'         => $player->age,
                'description' => $player->description,

                'competitions' => $competitions->map(function ($comp) {
                    return [
                        'competition_id' => $comp->_id,
                        'title'          => $comp->title,
                        'description'    => $comp->description,
                    ];
                })->values(),
            ];
        });
    }

    public function show(string $player_id) //SHOW player con competiciones (Mongo)
    {
        $player = PlayerPublic::findOrFail($player_id);

        $competitions = CompetitionPublic::whereIn(
            '_id',
            $player->competitions ?? []
        )->get();

        return [
            'player_id'   => $player->_id,
            'name'        => $player->name,
            'age'         => $player->age,
            'description' => $player->description,

            'competitions' => $competitions->map(function ($comp) {
                return [
                    'competition_id' => $comp->_id,
                    'title'          => $comp->title,
                    'description'    => $comp->description,
                ];
            }),
        ];
    }


    public function showCom(string $competition_id) //SHOW competition con sus players (Mongo)
    {
        $competition = CompetitionPublic::findOrFail($competition_id);

        $players = PlayerPublic::where(
            'competitions',
            $competition_id
        )->get();

        return [
            'competition_id' => $competition->_id,
            'title'          => $competition->title,
            'description'    => $competition->description,

            'players' => $players->map(function ($player) {
                return [
                    'player_id'   => $player->_id,
                    'name'        => $player->name,
                    'age'         => $player->age,
                    'description' => $player->description,
                ];
            }),
        ];
    }

    public function competitionsByPlayer(string $player_id)  //mostar un array de competiciones de un jugador
    {
        // 1️⃣ Buscar jugador
        $player = PlayerPublic::findOrFail($player_id);

        // 2️⃣ Normalizar competitions (MUY IMPORTANTE)
        $competitionIds = [];

        if (is_array($player->competitions)) {
            $competitionIds = $player->competitions;
        } elseif (is_string($player->competitions)) {
            $competitionIds = [$player->competitions];
        }

        // 3️⃣ Si no tiene competiciones → array vacío
        if (empty($competitionIds)) {
            return [];
        }

        // 4️⃣ Buscar competiciones
        $competitions = CompetitionPublic::whereIn('_id', $competitionIds)->get();

        // 5️⃣ Retornar solo lo que necesitas
        return $competitions->map(function ($comp) {
            return [
                'competition_id' => $comp->_id,
                'title'          => $comp->title,
            ];
        })->values();
    }
}
