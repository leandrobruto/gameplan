<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BankrollSeeder extends Seeder
{
    public function run()
    {
        $bankrollModel = new \App\Models\BankrollModel;

        $data = [
            [
                'currency_id' => 1,
                'name' => 'My Bankroll'
            ],
            [
                'currency_id' => 2,
                'name' => 'My Bankroll II'
            ],
        ];

        $bankrollModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($bankroll->errors());
    }
}
