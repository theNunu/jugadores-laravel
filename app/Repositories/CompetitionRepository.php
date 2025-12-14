<?php
namespace App\Repositories;
use App\Models\Competition;

class CompetitionRepository
{
    public function all()
    {
        return Competition::get();
    }

    public function find(string $id)
    {
        return Competition::where('competition_id', $id)->first();
    }

    public function create(array $data)
    {
        $competition = Competition::create($data);
        // $player->competitions()->sync($data['competition_ids'] ?? []);
        return $competition;
    }


    public function update(Competition $competition, array $data)
    {
        $competition->update($data);
        // $player->competitions()->sync($data['competition_ids'] ?? []);
        return $competition;
    }


    public function delete(Competition $competition)
    {
        $competition->delete();
    }
}
