<?php

namespace App\Models;

use CodeIgniter\Model;

class CompetitionModel extends Model
{
    protected $table            = 'competitions';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Competition';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['sport_id', 'name'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
