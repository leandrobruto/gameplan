<?php

namespace App\Models;

use CodeIgniter\Model;

class BankrollModel extends Model
{
    protected $table            = 'bankrolls';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Bankroll';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['user_id', 'currency_id', 'name', 'initial_balance', 'initial_date', 'comission', 'is_default'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required',
    ];

    public function getDefaultBankroll($user_id)
    {
        return [
            'user_id' => $user_id,
            'name' => 'My Bankroll',
            'currency_id' => 1,
            'initial_balance' => 0.00,
            'initial_date' => date("Y/m/d"),
            'comission' => 0,
            'is_default' => 1,
        ];
    }

    public function getUserBankrolls($user = null) {
        return $this->select('bankrolls.*, currencies.name AS currency')
                ->join('currencies', 'currencies.id = bankrolls.currency_id')
                ->where('bankrolls.user_id', $user->id)
                ->find();
    }

    

    public function getBankrollEvolution($user)
    {
        $resultSum = $this->selectSum('bets.result')
            ->join('bets', 'bets.bankroll_id = bankrolls.id')
            ->where('bankrolls.user_id', $user->id)
            ->where('bankrolls.is_default', 1)
            ->first();

            // dd($resultSum);
        if (!empty($resultSum->result))
        {
            return $this->select('bankrolls.initial_balance, (bankrolls.initial_balance + ' . $resultSum->result . ') as current_balance')
                ->join('bets', 'bets.bankroll_id = bankrolls.id')
                ->join('users', 'users.id = bankrolls.user_id')
                ->where('bankrolls.user_id', $user->id)
                ->where('bankrolls.is_default', 1)
                ->first();
        }

        return null;
    }
}
