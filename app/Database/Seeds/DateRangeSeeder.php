<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DateRangeSeeder extends Seeder
{
    public function run()
    {
        $dateRangeModel = new \App\Models\DateRangeModel();

        $data = [
            ['name' => 'This Month'],
            ['name' => 'Last 30 Days'],
            ['name' => 'Last 3 Months'],
            ['name' => 'Last 6 Months'],
        ];

        $dateRangeModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($currency->errors());
    }
}
