<?php

namespace App\Models;

use CodeIgniter\Model;

class StrategyModel extends Model
{
    protected $table            = 'strategies';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Strategy';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['name'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
