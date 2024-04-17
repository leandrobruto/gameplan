<?php

namespace App\Controllers\Manager\Account;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Competition;

class Integrations extends BaseController
{

    public function __construct()
    {

    }

    public function getIndex()
    {
        $data = [
            'title' => 'Integrations',
        ];
        
        return view('Manager/Account/Integrations/index', $data);
    }
}
