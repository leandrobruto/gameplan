<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionTypeModel extends Model
{
    protected $table            = 'transactions_types';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\TransactionType';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['name'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
