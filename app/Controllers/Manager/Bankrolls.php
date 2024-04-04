<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Bankrolls extends BaseController
{
    public function getIndex()
    {
        $data = [
            'title' => 'Bankrolls',
        ];
        
        return view('Manager/Dashboard/index', $data);
    }
}
