<?php

namespace App\Models;

use CodeIgniter\Model;

class BankrollModel extends Model
{
    protected $table            = 'bankrolls';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Bankroll';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['user_id', 'currency_id', 'name', 'initial_balance', 'comission', 'is_default'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
