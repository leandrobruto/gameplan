<?php

namespace App\Models;

use CodeIgniter\Model;

class SportModel extends Model
{
    protected $table            = 'sports';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Sport';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['name'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

     /**
     * @uso Controller Sports in the search method with autocomplete
     * @param string $term
     * @return array sports
     */
    public function search ($term) 
    {
        if ($term === null) {
            return [];
        }

        return $this->select('id, name')
                    ->like('name', $term)
                    ->withDeleted(true)
                    ->get()
                    ->getResult();
    }
}
