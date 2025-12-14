<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Models\Player;
use App\Services\PlayerService;
use Illuminate\Http\Request;


class PlayerController extends Controller
{

    protected $servicePlayer;
    public function __construct(PlayerService $servicePlayer) {
        $this->servicePlayer = $servicePlayer;
    }


    public function index()
    {
        return response()->json($this->servicePlayer->list());
    }


    public function store(PlayerRequest $request)
    {
        return response()->json($this->servicePlayer->create($request->validated()), 201);
    }


    public function show($player_id)
    {
        return response()->json($this->servicePlayer->show($player_id));
    }

        public function showCom($competition_id)
    {
        return response()->json($this->servicePlayer->showCom($competition_id));
    }


    public function update(Request $request, Player $player)
    {
        $data = $request->all();
        return response()->json($this->servicePlayer->update($player, $data));
    }


    public function destroy(Player $player)
    {
        $this->servicePlayer->delete($player);
        return response()->json(['message' => 'Deleted']);
    }
}
