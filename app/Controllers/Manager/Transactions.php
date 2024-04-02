<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Transactions extends BaseController
{
    public function getIndex()
    {
        echo 'Transactions';
    }
}
