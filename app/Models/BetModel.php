<?php

namespace App\Models;

use CodeIgniter\Model;

class BetModel extends Model
{
    protected $table            = 'bets';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Bet';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['user_id', 'bankroll_id', 'sport_id', 'competition_id', 'strategy_id', 'stake', 'result', 'description', 'is_pending'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
