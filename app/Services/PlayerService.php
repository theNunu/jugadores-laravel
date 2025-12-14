<?php

namespace App\Services;

use App\Models\Competition;
use App\Models\Player;
use App\Repositories\PlayerRepository;

class PlayerService
{
    protected PlayerRepository $playerRepository;
    public function __construct(PlayerRepository  $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }


    public function list()
    {
        // return $this->playerRepository->all();
        $players = Player::with('competitions')->get();

        return $players->map(function ($player) {
            return [
                'player_id'   => $player->player_id,
                'name'        => $player->name,
                'age'         => $player->age,
                'description' => $player->description,

                'competitions' => $player->competitions->map(function ($comp) {
                    return [
                        'competition_id' => $comp->competition_id,
                        'title'          => $comp->title,
                        'description'    => $comp->description,
                    ];
                }),
            ];
        });
    }

    public function show($player_id) //obtener un jugador con sus competiciones
    {
        $player = Player::where('player_id', $player_id)->get();
        // return $this->playerRepository->all();

        return $player->map(function ($p) {
            return [
                'player_id'   => $p->player_id,
                'name'        => $p->name,
                'age'         => $p->age,
                'description' => $p->description,

                'competitions' => $p->competitions->map(function ($comp) {
                    return [
                        'competition_id' => $comp->competition_id,
                        'title'          => $comp->title,
                        'description'    => $comp->description,
                    ];
                }),
            ];
        });
        // return $player->load('competitions');
    }

    public function showCom($competition_id) //obtener una competicion con sus jugadores 
    {
        $player = Competition::where('competition_id', $competition_id)->get();
        // return $this->playerRepository->all();

        return $player->map(function ($comp) {
            return [
                'competition_id' => $comp->competition_id,
                'title'          => $comp->title,
                'description'    => $comp->description,

                'players' => $comp->players->map(function ($p) {
                    return [
                        'player_id'   => $p->player_id,
                        'name'        => $p->name,
                        'age'         => $p->age,
                        'description' => $p->description,
                    ];
                }),
            ];
        });
        // return $player->load('competitions');
    }


    public function create(array $data)
    {
        return $this->playerRepository->create($data);
    }


    // public function update(Player $player, array $data)
    // {
    //     return $this->playerRepository->update($player, $data);
    // }
    public function update(array $data, string $playerId)
    {
        $player = $this->playerRepository->find($playerId);

        return $this->playerRepository->update($player, $data);
    }


    public function delete(Player $player)
    {
        $this->playerRepository->delete($player);
    }
}
