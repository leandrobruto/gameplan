<?php

namespace App\Models;

use CodeIgniter\Model;

class MatchModel extends Model
{
    protected $table            = 'matches';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Match';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['bet_id', 'event', 'odd'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
