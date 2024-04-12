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
        $bankroll = defaultBankroll();

        $data = [
            'title' => 'Home',
            'user' => $user,
            'bets' => $this->betModel->getBetsByUser($user, $bankroll)->paginate(10),
            'reports' => $reports = $this->betModel->getBetsReports($user, $bankroll),
            'pager' => $this->betModel->pager,
        ];
        
        return view('Manager/Dashboard/index', $data);
    }
}
