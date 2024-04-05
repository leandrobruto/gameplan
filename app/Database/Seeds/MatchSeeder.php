<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MatchSeeder extends Seeder
{
    public function run()
    {
        $matchModel = new \App\Models\MatchModel;

        $data = [
            [
                'bet_id' => 1,
                'event' => 'Corinthians x Palmeiras',
                'date' => '2024-04-04',
                'odd' => 1.31,
            ],
            [
                'bet_id' => 2,
                'event' => 'Icasa x Fortaleza',
                'date' => '2024-04-05',
                'odd' => 1.31,
            ],
        ];

        $matchModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($bankroll->errors());
    }
}
