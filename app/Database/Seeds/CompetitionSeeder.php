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
                'user_id' => 1,
                'sport_id' => 1, 
                'name' => 'Bundesliga'
            ],
            [
                'user_id' => 1,
                'sport_id' => 1, 
                'name' => 'Champions League'
            ],
            [
                'user_id' => 1,
                'sport_id' => 3, 
                'name' => 'Tennis'
            ],

            [
                'user_id' => 1,
                'sport_id' => 5, 
                'name' => 'CBLOL'
            ],
        ];

        $competitionModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($data->errors());
    }
}
