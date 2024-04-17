<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Payments extends BaseController
{
    public function getIndex()
    {
        $data = [
            'title' => 'Payments'
        ];

        return view('Manager/Payments/index', $data);
    }
}
