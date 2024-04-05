<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BetSeeder extends Seeder
{
    public function run()
    {
        $betModel = new \App\Models\BetModel;

        $data = [
            [
                'user_id' => 1,
                'bankroll_id' => 1,
                'sport_id' => 1,
                'competition_id' => 1,
                'strategy_id' => 1,
                'code' => '12345678',
                'stake' => 1,
                'result' => 0.31,
                'description' => 'Shou dibola',
                'is_pending' => 0,
            ],
            [
                'user_id' => 1,
                'bankroll_id' => 1,
                'sport_id' => 1,
                'competition_id' => 2,
                'strategy_id' => 1,
                'code' => '87654321',
                'stake' => 2,
                'result' => 1.20,
                'description' => 'Shou dibola II',
                'is_pending' => 0,
            ],
        ];

        $betModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($bankroll->errors());
    }
}
