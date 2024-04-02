<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function getIndex()
    {
        $data = [
            'title' => 'Home',
        ];
        
        return view('Manager/Dashboard/index', $data);
    }
}
