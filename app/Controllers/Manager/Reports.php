<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Reports extends BaseController
{
    private $bankrollModel;
    private $user;

    public function __construct()
    {
        $this->bankrollModel = new \App\Models\BankrollModel();
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Reports',
        ];
        
        return view('Manager/Reports/index', $data);
    }

    public function getBankroll_Evolution()
    {
        $user = userLoggedIn();
        $reports = $this->bankrollModel->getBankrollEvolution($user);

        $data = [
            'title' => 'Bankroll Evolution',
            'reports' => $reports,
        ];

        return view('Manager/Reports/bankroll-evolution', $data);
    }
}
