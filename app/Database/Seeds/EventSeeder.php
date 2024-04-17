<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        $eventModel = new \App\Models\EventModel;

        $data = [
            [
                'bet_id' => 1,
                'name' => 'Corinthians x Palmeiras',
                'odd' => 1.31,
            ],
            [
                'bet_id' => 2,
                'name' => 'Icasa x Fortaleza',
                'odd' => 1.31,
            ],
        ];

        $eventModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($data->errors());
    }
}
