<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Bankroll extends Entity
{
    protected $dates   = [
        'created_at', 
        'updated_at', 
        'deleted_at'
    ];
}
