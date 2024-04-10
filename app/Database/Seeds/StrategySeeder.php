<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StrategySeeder extends Seeder
{
    public function run()
    {
        $strategyModel = new \App\Models\StrategyModel;

        $data = [
            [
                'user_id' => 1,
                'sport_id' => 1, 
                'name' => 'Match Winner',
                'description' => 'Match Winner',
            ],
            [
                'user_id' => 1,
                'sport_id' => 1, 
                'name' => 'Draw no Bet',
                'description' => 'Draw no Bet',
            ],
            [
                'user_id' => 1,
                'sport_id' => 1, 
                'name' => 'Double Chance',
                'description' => 'Double Chance',
            ],
        ];

        $strategyModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($bankroll->errors());
    }
}
