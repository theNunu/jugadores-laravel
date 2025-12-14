<?php

use App\Models\Player;

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
