<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Reports extends BaseController
{
    public function getIndex()
    {
        $data = [
            'title' => 'Reports',
        ];
        
        return view('Manager/Reports/index', $data);
    }
}
