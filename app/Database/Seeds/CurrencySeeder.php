<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run()
    {
        $currencyModel = new \App\Models\CurrencyModel;

        $data = [
            ['name' => 'Brazilian Real (R$)'],
            ['name' => 'Dollar ($)'],
            ['name' => 'Euro (€)'],
        ];

        $currencyModel->skipValidation(true)->protect(false)->insertBatch($data);

        // dd($currency->errors());
    }
}
