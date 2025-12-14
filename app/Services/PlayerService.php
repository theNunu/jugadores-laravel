<?php
namespace App\Services;
use App\Models\Player;
use App\Repositories\PlayerRepository;

class PlayerService
{
    protected PlayerRepository $playerRepository;
    public function __construct( PlayerRepository  $playerRepository) {
        $this->playerRepository = $playerRepository;
    }


    public function list()
    {
        return $this->playerRepository->all();
    }

      public function show($player_id)
    {
        $player = Player::find($player_id);
        // return $this->playerRepository->all();
        return $player->load('competitions');
    }


    public function create(array $data)
    {
        return $this->playerRepository->create($data);
    }


    public function update(Player $player, array $data)
    {
        return $this->playerRepository->update($player, $data);
    }


    public function delete(Player $player)
    {
        $this->playerRepository->delete($player);
    }
}
