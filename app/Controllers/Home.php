<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function getIndex()
    {
        $user = service('auth')->getUserLoggedIn();

        // if ($user) {
        //     return redirect()->to(site_url('manager/dashboard'));
        // }

        $data = [
            'title' => 'Welcome, Cordylus!',
            'user' => $user,
        ];
        
        return view('Home/index', $data);
    }
}
