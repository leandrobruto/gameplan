<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    public function run()
    {
        $transactionTypeModel = new \App\Models\TransactionTypeModel;

        $data = [
            ['name' => 'Deposit'],
            ['name' => 'Withdrawal'],
        ];

        $transactionTypeModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($data->errors());
    }
}
