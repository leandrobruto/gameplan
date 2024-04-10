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
            'initial_date' => date("Y/m/d"),
            'is_default' => 1,
        ];
    }

    public function getUserBankrolls($user = null) {
        return $this->select('bankrolls.*, currencies.name AS currency')
                ->join('currencies', 'currencies.id = bankrolls.currency_id')
                ->where('bankrolls.user_id', $user->id)
                ->find();
    }
}
