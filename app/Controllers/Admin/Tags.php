<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Tags extends BaseController
{
    public function getIndex()
    {
        echo 'Page Tags';
    }
}
