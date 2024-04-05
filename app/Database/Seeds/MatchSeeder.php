<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MatchSeeder extends Seeder
{
    public function run()
    {
        $matchModel = new \App\Models\MatchModel;

        $data = [
            ['user_id' => 1],
        ];

        $matchModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($bankroll->errors());
    }
}
