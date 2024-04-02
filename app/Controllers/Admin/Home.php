<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    public function getIndex($id = null)
    {
        $user = service('auth')->getUserLoggedIn();

        $data = [
            'title' => 'Welcome, Cordylus!',
            'user' => $user,
        ];
        
        return view('Admin/Home/index', $data);
    }
}
