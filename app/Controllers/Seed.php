<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Seed extends BaseController
{
    public function getIndex()
    {
        $seeder = \Config\Database::seeder();

        $seeder->call('UserSeeder');
        $seeder->call('DateRangeSeeder');
        $seeder->call('SportSeeder');
        $seeder->call('ProfileSeeder');
        $seeder->call('CurrencySeeder');
        $seeder->call('BankrollSeeder');
        $seeder->call('CompetitionSeeder');
        $seeder->call('StrategySeeder');
        $seeder->call('BetSeeder');
        $seeder->call('MatchSeeder');
        
        echo 'Seeded.';
    }
}
