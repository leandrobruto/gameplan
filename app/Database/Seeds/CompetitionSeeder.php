<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    public function run()
    {
        $competitionModel = new \App\Models\CompetitionModel;

        $data = [
            ['name' => 'Bundesliga'],
            ['name' => 'Champions League'],
            ['name' => 'Tennis'],
        ];

        $competitionModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($bankroll->errors());
    }
}
