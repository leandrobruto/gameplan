<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function getIndex()
    {
        $user = service('auth')->getUserLoggedIn();

        $data = [
            'title' => 'Welcome, Cordylus!',
            'user' => $user,
        ];
        
        return view('Home/index', $data);
    }
}
