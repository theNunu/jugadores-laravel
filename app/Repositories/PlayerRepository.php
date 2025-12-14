<?php

namespace App\Repositories;

use App\Models\Player;

class PlayerRepository
{
    public function all()
    {
        return Player::with('competitions')->get();
    }

    public function find(string $id)
    {
        return Player::with('competitions')->where('player_id', $id)->first();
    }

    public function create(array $data)
    {
        $player = Player::create($data);
        $player->competitions()->sync($data['competition_ids'] ?? []);

        // Recargar relaciones para devolver el jugador con sus competiciones
        return $player->load('competitions');
    }


    public function update(Player $player, array $data)
    {
        $player->update($data);
        $player->competitions()->sync($data['competition_ids'] ?? []);
        return $player;
    }


    public function delete(Player $player)
    {
        $player->delete();
    }
}
