<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    public function run()
    {
        $competitionModel = new \App\Models\CompetitionModel;

        $data = [
            [
                'sport_id' => 1, 
                'name' => 'Bundesliga'
            ],
            [
                'sport_id' => 1, 
                'name' => 'Champions League'
            ],
            [
                'sport_id' => 3, 
                'name' => 'Tennis'
            ],
        ];

        $competitionModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($bankroll->errors());
    }
}
