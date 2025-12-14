<?php
namespace App\Services;
// use App\Models\Player;

use App\Models\Competition;
use App\Repositories\CompetitionRepository;

class CompetitionService
{
    protected $competitionRepository;
    public function __construct(CompetitionRepository $competitionRepository) {
        $this->competitionRepository = $competitionRepository;
    }


    public function list()
    {
        return $this->competitionRepository->all();
    }

    public function show($competition_id)
    {
        $competition = Competition::find($competition_id);
        return $competition;
        // return $competition->load('players');
    }


    public function create(array $data)
    {
        return $this->competitionRepository->create($data);
    }


    public function update(Competition $competition, array $data)
    {
        return $this->competitionRepository->update($competition, $data);
    }


    public function delete(Competition $competition)
    {
        $this->competitionRepository->delete($competition);
    }
}
