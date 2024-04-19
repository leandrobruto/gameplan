<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Transactions extends BaseController
{
    private $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new \App\Models\TransactionModel();
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Transactions',
            'transactions' => $this->transactionModel->findAll(),
            'pager' => $this->transactionModel->pager,
        ];
        
        return view('Manager/Transactions/index', $data);
    }
}
