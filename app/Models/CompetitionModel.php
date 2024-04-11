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

    public function getCompetitionsByUser($user) {
        return $this->select('competitions.*')
                ->join('users', 'users.id = competitions.user_id')
                ->where('competitions.user_id', $user->id)
                ->find();
    }
}
