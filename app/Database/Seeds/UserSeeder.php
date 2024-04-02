<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new \App\Models\UserModel;

        $user = [
            'username' => 'Ademiro',
            'email' => 'ademiro@admin.com',
            'password' => '123qweasd',
            'is_admin' => true,
            'active' => true,
        ];

        $userModel->skipValidation(true)->protect(false)->insert($user);

        // dd($user->errors());
    }
}