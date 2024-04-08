<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    private $betModel;
    private $matchModel;
    private $sportModel;
    private $competitionModel;
    private $strategyModel;
    private $bankrollModel;

    public function __construct()
    {
        $this->betModel = new \App\Models\BetModel();
        $this->matchModel = new \App\Models\MatchModel();
        $this->bankrollModel = new \App\Models\BankrollModel();
    }

    public function getIndex()
    {
        $user = userLoggedIn();

        $data = [
            'title' => 'Bets',
            'user' => $user,
            'bets' => $this->betModel->findBetsByUser($user)->paginate(10),
            'count' => $this->betModel->countAllBetsByUser($user),
            'pager' => $this->betModel->pager,
        ];

        $bankroll = $this->bankrollModel->where('user_id', $user->id)->first();

        $reports = $this->betModel->getReportsByUser($user);

        if (isset($reports->result)) {
            $data['result'] = $reports->result;
            $data['averageProfit'] = number_format($reports->result / 2, 2);
            $data['roi'] = number_format(($reports->result / $reports->stake) * 100, 2);
            $data['balance'] = number_format($bankroll->initial_balance + $reports->result, 2);
            $data['biggest_win'] = $reports->max_result;
            $data['bankroll'] = $bankroll;
        } else {
            $data['result'] = 0;
            $data['averageProfit'] = 0;
            $data['roi'] = 0;
            $data['balance'] = 0;
            $data['biggest_win'] = 0;
            $data['bankroll'] = 0;
        }
        
        return view('Manager/Dashboard/index', $data);
    }
}
