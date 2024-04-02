<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Bets extends BaseController
{
    public function getIndex()
    {
        $data = [
            'title' => 'Bets',
        ];
        
        return view('Manager/Bets/index', $data);
    }
}
