<?php

namespace App\Models;

use CodeIgniter\Model;

class BetModel extends Model
{
    protected $table            = 'bets';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Bet';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['user_id', 'bankroll_id', 'sport_id', 'competition_id', 'strategy_id', 'code', 'stake', 'result', 'description', 'is_pending'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    /**
     * @uso Controller Bets in the search method getIndex
     * @param int $user_id
     * @return array bets
     */
    public function findBetsByUser($user = null) 
    {
        return $this->select('bets.*, 
            matches.event, matches.date,
            bankrolls.name AS bankroll, 
            sports.name AS sport, 
            competitions.name AS competition, 
            strategies.name AS strategy')->asObject()
                ->join('matches', 'bets.id = matches.bet_id')
                ->join('sports', 'bets.sport_id = sports.id')
                ->join('competitions', 'bets.competition_id = competitions.id')
                ->join('strategies', 'bets.strategy_id = strategies.id')
                ->join('bankrolls', 'bets.bankroll_id = bankrolls.id')
                ->where('bets.user_id', $user->id);
    }

    public function countAllBetsByUser($user) 
    {
        return $this->where('bets.user_id', $user->id)
            ->countAllResults();
    }

    public function getReportsByUser($user) 
    {
        return $this->selectSum('stake')
            ->selectSum('result')
            ->selectMax('result', 'max_result')
            ->where('user_id', $user->id)
            ->first();
    }

    public function generateBetCode() 
    {
    
        do {
            
            $betCode = random_string('numeric', 8);

            $this->where('code', $betCode);

        } while ($this->countAllResults() > 1);
    
        return $betCode;
    }
}
