<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Player;
use App\Services\PlayerService;
use Illuminate\Http\Request;


class PlayerController extends Controller
{

    protected $servicePlayer;
    public function __construct(PlayerService $servicePlayer)
    {
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


    // public function update(  UpdatePlayerRequest $request, $player_id)
    // {
    //     $data = $request->all();
    //     return response()->json($this->servicePlayer->update($player, $data));
    // }
    public function update(UpdatePlayerRequest $request, string $player_id)
    {
        return response()->json(
            $this->servicePlayer->update($request->validated(), $player_id)
        );
    }
    public function destroy(string $player_id)
    {
        $this->servicePlayer->delete($player_id);

        return response()->json([
            'message' => 'Player deleted successfully'
        ], 200);
    }
}
