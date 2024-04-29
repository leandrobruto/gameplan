<?php

namespace App\Models;

use CodeIgniter\Model;

class BetModel extends Model
{
    protected $table            = 'bets';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Bet';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'user_id', 'bankroll_id', 'sport_id', 'competition_id', 'strategy_id', 
        'code', 'date', 'stake', 'result', 'description', 'is_pending'
    ];

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
    public function getBetsByUser($user, $bankroll) 
    {
        return $this->select('bets.*, ((bets.result / bets.stake)) * 100 AS roi,
            events.name AS event, events.odd, bets.date,
            bankrolls.name AS bankroll, 
            sports.name AS sport, 
            competitions.name AS competition, 
            strategies.name AS strategy')->asObject()
                ->join('events', 'bets.id = events.bet_id')
                ->join('sports', 'bets.sport_id = sports.id', 'left')
                ->join('competitions', 'bets.competition_id = competitions.id', 'left')
                ->join('strategies', 'bets.strategy_id = strategies.id', 'left')
                ->join('bankrolls', 'bets.bankroll_id = bankrolls.id')
                ->where('bets.user_id', $user->id)
                ->where('bets.bankroll_id', $bankroll->id)
                ->orderBy('bets.date', 'DESC');
    }

    public function getBetsByStatus($user, $bankroll, $status) 
    {
        return $this->select('bets.*, ((bets.result / bets.stake)) * 100 AS roi,
            events.name AS event, events.odd, bets.date,
            bankrolls.name AS bankroll, 
            sports.name AS sport, 
            competitions.name AS competition, 
            strategies.name AS strategy')->asObject()
                ->join('events', 'bets.id = events.bet_id')
                ->join('sports', 'bets.sport_id = sports.id', 'left')
                ->join('competitions', 'bets.competition_id = competitions.id', 'left')
                ->join('strategies', 'bets.strategy_id = strategies.id', 'left')
                ->join('bankrolls', 'bets.bankroll_id = bankrolls.id')
                ->where('bets.user_id', $user->id)
                ->where('bets.bankroll_id', $bankroll->id)
                ->where('bets.is_pending', $status)
                ->orderBy('bets.date', 'DESC');
    }

    public function countAllBetsByUser($user) 
    {
        return $this->where('bets.user_id', $user->id)
            ->countAllResults();
    }

    public function getBetsReports($user, $bankroll) 
    {
        $reports = $this->selectCount('bets.id', 'total_bets') // Número de Bets
            ->selectSum('stake', 'stake_sum')                  // Soma de todas as Stakes
            ->selectSum('result', 'result_sum')                // Soma de todos os Resultados
            ->selectMin('result', 'min_result')                // Resultado Mínimo
            ->selectMax('result', 'max_result')                // Resultado Máximo
            ->selectAvg('result', 'average_profit')            // Lucro Médio
            ->where('user_id', $user->id)
            ->where('bankroll_id', $bankroll->id)
            ->first();

        if (!empty($reports->result_sum) || !empty($reports->stake_sum))
        {
            $reports->roi = ($reports->result_sum / $reports->stake_sum) * 100;             // Cálculo do ROI
            $reports->initial_balance = $bankroll->initial_balance;                         // Intitial Balance
            $reports->current_balance = $bankroll->initial_balance + $reports->result_sum;  // Current Balance

            $max_loss = $this->selectSum('stake', 'total_loss')
                ->selectMax('stake', 'max_stake')
                ->where('result', 0)
                ->where('user_id', $user->id)
                ->where('bankroll_id', $bankroll->id)
                ->first();

            $reports->total_loss = $max_loss->total_loss;
            $reports->max_loss = $max_loss->max_stake;
        }

        return $reports;
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
