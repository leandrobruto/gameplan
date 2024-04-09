<?php

namespace App\Models;

use CodeIgniter\Model;

class DateRangeModel extends Model
{
    protected $table            = 'date_ranges';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\DateRange';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['name'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
