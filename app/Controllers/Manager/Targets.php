<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Targets extends BaseController
{
    public function getIndex()
    {
        $data = [
            'title' => 'Targets',
        ];
        
        return view('Manager/Targets/index', $data);
    }
}
