<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Bets extends BaseController
{
    private $sportModel;
    private $competitionModel;
    private $strategyModel;
    
    public function __construct()
    {
        $this->userModel = new \App\Models\SportModel();
        $this->competitionModel = new \App\Models\CompetitionModel();
        $this->strategyModel = new \App\Models\StrategyModel();
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Bets',
            'sports' => $this->userModel->findAll(),
            'competitions' => $this->competitionModel->findAll(),
            'strategies' => $this->strategyModel->findAll(),
        ];
        
        return view('Manager/Bets/index', $data);
    }
}
