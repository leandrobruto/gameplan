<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table            = 'profiles';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\Profile';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['user_id', 'name', 'cpf', 'phone', 'avatar'];

    // Validation
    // protected $validationRules      = [
    //     'cpf' => 'exact_length[14]|validateCpf|is_unique[users.cpf]'
    // ];

    // protected $validationMessages   = [
    //     'cpf' => [
    //         'is_unique' => 'Sorry. This CPF already exists.',
    //     ],
    // ];

    /**
     * @uso no controller Users/show
     * @param int $user_id
     * @return array objetos
     */
    public function findProfileByUserId(int $user_id) {
        return $this->select('profiles.*', 'users.*')
                ->join('users', 'users.id = profiles.user_id')
                ->where('profiles.user_id', $user_id)
                ->first();
    }
}