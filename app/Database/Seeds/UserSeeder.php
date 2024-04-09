<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new \App\Models\UserModel;

        $user = [
            'username' => 'ademiro',
            'email' => 'ademiro@admin.com',
            'password' => '123123',
            'is_admin' => true,
            'active' => true,
        ];

        $userModel->skipValidation(true)->protect(false)->insert($user);

        // dd($user->errors());
    }
}