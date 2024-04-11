<?php

namespace App\Models;

use CodeIgniter\Model;

class StrategyModel extends Model
{
    protected $table            = 'strategies';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Strategy';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['user_id', 'sport_id', 'name'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getDefaultStrategies($user_id) 
    {
        return [
            [
                'user_id' => $user_id,
                'sport_id' => 1,
                'name' => 'Match Winner',
                'description' => 'Example',
            ],
            [
                'user_id' => $user_id,
                'sport_id' => 1,
                'name' => 'Double Chance',
                'description' => 'Example',
            ],
            [
                'user_id' => $user_id,
                'sport_id' => 1,
                'name' => 'Draw No Bet',
                'description' => 'Example',
            ]
        ];
    }

    /**
     * @uso Controller Strategies in the search method with autocomplete
     * @param string $term
     * @return array strategies
     */
    public function search ($term, $user) 
    {
        if ($term === null) {
            return [];
        }

        return $this->select('strategies.id, strategies.name')
                    ->join('users', 'users.id = strategies.user_id')
                    ->like('name', $term)
                    ->where('users.id', $user->id)
                    ->get()
                    ->getResult();
    }

    public function getStrategiesByUser($user) {
        return $this->select('strategies.*')
                ->join('users', 'users.id = strategies.user_id')
                ->where('strategies.user_id', $user->id)
                ->find();
    }
}
