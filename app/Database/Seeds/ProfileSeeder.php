<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        $profileModel = new \App\Models\ProfileModel;

        $data = [
            ['user_id' => 1, 'first_name' => 'Dango', 'last_name' => 'Balango', 
            'default_stake' => null, 'default_date_range_id' => 1, 'default_sport_id' => 1,]
        ];
        
        $profileModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($data->errors());
    }
}
