<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    private $betModel;
    private $bankrollModel;

    public function __construct()
    {
        $this->betModel = new \App\Models\BetModel();
        $this->bankrollModel = new \App\Models\BankrollModel();
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Home',
            'bets' => $this->betModel->findAll(),
        ];

        $bet = $this->betModel->first();
        $bankroll = $this->bankrollModel->first();
        $data['result'] = $bet ? $bet->result : 0;
        $data['roi'] = $bet ? ($bet->result / $bet->stake) * 100 : 0;
        $data['balance'] = ($bankroll ? $bankroll->initial_balance  : 0) + ($bet ? $bet->result : 0);
        
        return view('Manager/Dashboard/index', $data);
    }
}
