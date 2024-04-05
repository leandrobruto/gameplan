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
                'user_id' => 1,
                'currency_id' => 1,
                'name' => 'My Bankroll',
                'initial_balance' => 100.00,
            ],
            [
                'user_id' => 1,
                'currency_id' => 2,
                'name' => 'My Bankroll II',
                'initial_balance' => 100.00,
            ],
        ];

        $bankrollModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($bankroll->errors());
    }
}
