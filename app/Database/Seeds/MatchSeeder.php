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
                'odd' => 1.31,
            ],
            [
                'bet_id' => 2,
                'event' => 'Icasa x Fortaleza',
                'odd' => 1.31,
            ],
        ];

        $matchModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($data->errors());
    }
}
