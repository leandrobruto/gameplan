<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Diary extends BaseController
{
    public function getIndex()
    {
        $data = [
            'title' => 'Diary',
        ];
        
        return view('Manager/Diary/index', $data);
    }
}
