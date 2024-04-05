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
                'name' => 'Match Winner',
                'description' => 'Match Winner',
            ],
            [
                'name' => 'Draw no Bet',
                'description' => 'Draw no Bet',
            ],
            [
                'name' => 'Double Chance',
                'description' => 'Double Chance',
            ],
        ];

        $strategyModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($bankroll->errors());
    }
}
