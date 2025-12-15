<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PublicService;
use Illuminate\Http\Request;


class PublicController extends Controller
{

    protected $publicService;
    public function __construct(PublicService $publicService)
    {
        $this->publicService = $publicService;
    }


    public function index()
    {
        // dd('index public');
        return response()->json($this->publicService->list());
    }

    public function show($player_id)
    {
        return response()->json($this->publicService->show($player_id));
    }

    public function showCom($competition_id)
    {
        return response()->json($this->publicService->showCom($competition_id));
    }

    public function competitions(string $player_id)
    {
        return response()->json(
            $this->publicService->competitionsByPlayer($player_id)
        );
    }
}
