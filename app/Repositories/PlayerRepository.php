<?php

namespace App\Repositories;

use App\Models\Mongo\PlayerPublic;
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

        if (!empty($data['competition_ids'])) {
            $player->competitions()->sync($data['competition_ids']);
        }

        // 🔑 AQUÍ ya existe el pivot
        $this->syncMongo($player);

        // Recargar relaciones para devolver el jugador con sus competiciones
        return $player->load('competitions');
    }


    // public function update(Player $player, array $data)
    // {
    //     $player->update($data);
    //     $player->competitions()->sync($data['competition_ids'] ?? []);
    //     return $player;
    // }

    public function update(Player $player, array $data)
    {
        $player->update($data);

        if (array_key_exists('competition_ids', $data)) {
            $player->competitions()->sync($data['competition_ids']);
        }

        // 🔑 Mongo refleja exactamente el nuevo estado
        $this->syncMongo($player);

        return $player->load('competitions');
    }

    public function delete(Player $player)
    {
        $player->delete();
        $this->deleteMongo($player->player_id);
    }

    public function syncMongo(Player $player): void
    {
        PlayerPublic::updateOrCreate(
            ['_id' => $player->player_id],
            [
                'name' => $player->name,
                'age' => $player->age,
                'description' => $player->description,
                'competitions' => $player->competitions()
                    ->pluck('competitions.competition_id')
                    ->toArray(),
                'created_at' => $player->created_at,
                'updated_at' => now(),
            ]
        );
    }

    public function deleteMongo(string $playerId): void
    {
        PlayerPublic::where('_id', $playerId)->delete();
    }
}
