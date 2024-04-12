<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Token;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $returnType       = 'App\Entities\User';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['username', 'email', 'password', 'reset_hash', 'reset_expires_in', 'activation_hash'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'username' => 'required|min_length[4]|max_length[120]|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'password_confirmation' => 'required_with[password]|matches[password]',
    ];

    protected $validationMessages   = [
        'username' => [
            'required' => 'The field Username is required.',
        ],
        'email' => [
            'required' => 'The field Email is required.',
            'is_unique' => 'Sorry. this email already exists.',
        ],
        'password' => [
            'required' => 'The field Password is required.',
        ],
        'password_confirmation' => 'The Password confirmation field does not match the password field.'
    ];

    // Callback
    protected $beforeInsert = ['hasPassword'];
    protected $beforeUpdate = ['hasPassword'];

    public function hasPassword(array $data) 
    {

        if (isset($data['data']['password'])) 
        {
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        }

        return $data;
    }

    /**
     * @uso Controller users in the search method with autocomplete
     * @param string $term
     * @return array users
     */
    public function search ($term) 
    {
        if ($term === null) {
            return [];
        }

        return $this->select('users.id, users.username, profiles.first_name, profiles.last_name')
                    ->like('users.username', $term)
                    ->orLike('profiles.first_name', $term)
                    ->orLike('profiles.last_name', $term)
                    ->join('profiles', 'profiles.user_id = users.id')
                    ->withDeleted(true)
                    ->get()
                    ->getResult();
    }

    public function disablePasswordValidation() 
    {
        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);
    }

    public function disablePhoneValidation() 
    {
        unset($this->validationRules['phone']);
    }

    public function undoDelete(int $id) 
    {
        return $this->protect(false)
                    ->where('id', $id)
                    ->set('deleted_at', null)
                    ->update();
    }

    /**
     * @uso Class Auth
     * @param string $email
     * @return object $user
     */
    public function findUserByEmail(string $email) 
    {
        return $this->where('email', $email)->first();
    }

    public function findUserByUsernameOrEmail(string $data) 
    {
        return $this->where('email', $data)->orWhere('username', $data)->first();
    }

    public function findUserToResetPassword(string $token) {

        $token = new Token($token);

        $tokenHash = $token->getHash();

        $user = $this->where('reset_hash', $tokenHash)->first();
        
        if ($user != null) {

            /**
             * We check if the token is not expired according to the current date and time
             */
            if ($user->reset_expires_in < date('Y-m-d H:i:s')) {

                /**
                 * Token is expired, so we set $user = null
                 */
                $user = null;
            }
            
            return $user;
        }
    }

    public function activateAccountByToken(string $token) 
    {
        $token = new Token($token);

        $tokenHash = $token->getHash();

        $user = $this->where('activation_hash', $tokenHash)->first();

        if ($user != null) {
            
            $user->activate();

            $this->protect(false)->save($user);
        }
    }

    public function getUserWithProfile($user) {
        return $this->select('users.*, profiles.*')
                ->join('profiles', 'profiles.user_id = users.id')
                ->where('profiles.user_id', $user->id)
                ->first();
    }

    public function getAllUsersWithProfile() {
        return $this->select('users.*, profiles.*')
                ->join('profiles', 'profiles.user_id = users.id');
    }
}
