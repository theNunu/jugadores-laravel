<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompetitionRequest;
use App\Models\Competition;
// use CompetitionService;
use Illuminate\Http\Request;
use App\Services\CompetitionService;


class CompetitionController extends Controller
{

    protected $competitionService;
    public function __construct(CompetitionService $competitionService)
    {
        $this->competitionService = $competitionService;
    }


    public function index()
    {
        return response()->json($this->competitionService->list());
    }


    public function store(CompetitionRequest $request)
    {
        return response()->json($this->competitionService->create($request->validated()), 201);
    }


    public function show($competition_id)
    {
        return response()->json($this->competitionService->show($competition_id));
    }


    public function update(Request $request, Competition $competition)
    {
        $data = $request->all();
        return response()->json($this->competitionService->update($competition, $data));
    }


    public function destroy(Competition $competition)
    {
        $this->competitionService->delete($competition);
        return response()->json(['message' => 'Deleted']);
    }
}
