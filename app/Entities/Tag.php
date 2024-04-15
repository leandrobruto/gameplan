<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Tag extends Entity
{
    protected $dates   = [
        'created_at', 
        'updated_at', 
        'deleted_at'
    ];
}
