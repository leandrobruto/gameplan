<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SportSeeder extends Seeder
{
    public function run()
    {
        $sportModel = new \App\Models\SportModel;

        $data = [
            ['name' => 'Soccer'],
            ['name' => 'Basketball'],
            ['name' => 'Tennis'],
            ['name' => 'Counter Strike'],
            ['name' => 'League of Legends'],
        ];

        $sportModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($data->errors());
    }
}
