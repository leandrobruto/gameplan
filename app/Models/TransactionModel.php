<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Transaction';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['bankroll_id', 'transaction_type_id', 'date', 'value', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getTransactions($bankroll) 
    {            
        return $this->select('transactions.*, transactions_types.name AS type')
                ->join('transactions_types', 'transactions_types.id = transactions.transaction_type_id')
                ->where('transactions.bankroll_id', $bankroll->id)
                ->orderBy('transactions.created_at', 'DESC');
    }

    public function getTransactionsReports($bankroll) 
    {
        $deposit = $this->selectSum('transactions.value')
                    ->join('transactions_types', 'transactions_types.id = transactions.transaction_type_id')
                    ->where('transactions.bankroll_id', $bankroll->id)
                    ->where('transactions.transaction_type_id = 1')->first();

        $withdrawal = $this->selectSum('transactions.value')
                    ->join('transactions_types', 'transactions_types.id = transactions.transaction_type_id')
                    ->where('transactions.bankroll_id', $bankroll->id)
                    ->where('transactions.transaction_type_id = 2')->first();  

        $result = $withdrawal->value - $deposit->value;

        $reports = $this;
        $reports->deposit = $deposit->value;
        $reports->withdrawal = $withdrawal->value;
        $reports->result = $result;

        return $reports;
    }
}
