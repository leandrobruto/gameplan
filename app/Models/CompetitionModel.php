<?php

namespace App\Models;

use CodeIgniter\Model;

class CompetitionModel extends Model
{
    protected $table            = 'competitions';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Competition';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['user_id', 'sport_id', 'name'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getDefaultCompetitions($user_id)
    {
        return [
            [
                'user_id' => $user_id,
                'sport_id' => 1,
                'name' => 'Bundesliga',
            ],
            [
                'user_id' => $user_id,
                'sport_id' => 1,
                'name' => 'Champions League',
            ],
            [
                'user_id' => $user_id,
                'sport_id' => 1,
                'name' => 'Campeonato Cearense',
            ]
        ];
    }
    
    /**
     * @uso Controller Competitions in the search method with autocomplete
     * @param string $term
     * @return array competitions
     */
    public function search ($term, $user) 
    {
        if ($term === null) {
            return [];
        }

        return $this->select('competitions.id, competitions.name')
                    ->join('users', 'users.id = competitions.user_id')
                    ->like('name', $term)
                    ->where('users.id', $user->id)
                    ->get()
                    ->getResult();
    }

    public function getCompetitionsByUser($user) {
        return $this->select('competitions.*, sports.name AS sport_name')
                ->join('users', 'users.id = competitions.user_id')
                ->join('sports', 'sports.id = competitions.sport_id')
                ->where('competitions.user_id', $user->id);
    }
}
