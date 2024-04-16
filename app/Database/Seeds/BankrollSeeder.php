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
                'initial_date' => '2024/04/04',
                'comission' => 0,
                'is_default' => 1,
            ],
            [
                'user_id' => 1,
                'currency_id' => 2,
                'name' => 'My Bankroll II',
                'initial_balance' => 50.00,
                'initial_date' => '2024/04/05',
                'comission' => 0,
                'is_default' => 0,
            ],
        ];

        $bankrollModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($data->errors());
    }
}
