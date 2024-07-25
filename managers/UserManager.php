<?php

namespace Managers;

use Core\AbstractManager;
use Entities\User;

class UserManager extends AbstractManager
{
    public function __construct()
    {
        $this->model = User::class;
    }
    
    public function findByUsername( $username )
    {
        $result = $this->findBy([ 'username' => $username ]);
        
        return count($result) > 0 ? $result[0] : null;
    }
    
    public function createUser( $newUser )
    {
        $query = $this->getDb()->prepare("INSERT INTO user (username, password, role_id) VALUES (:username, :password, :role_id)");
        $query->execute([
            'username' => $newUser['username'],
            'password' => password_hash( $newUser['password'], PASSWORD_BCRYPT ),
            'role_id'  => 2
        ]);
    }
}