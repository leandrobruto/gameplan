<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BetSeeder extends Seeder
{
    public function run()
    {
        $betModel = new \App\Models\BetModel;

        $data = [
            ['user_id' => 1],
        ];

        $betModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($bankroll->errors());
    }
}
