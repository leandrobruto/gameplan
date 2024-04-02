<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Diary extends BaseController
{
    public function getIndex()
    {
        echo 'Diary';
    }
}
