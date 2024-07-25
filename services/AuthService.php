<?php

namespace Services;

use Managers\UserManager;

class AuthService
{
    public static function authUser( $user )
    {
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'role' => $user->getRole()->getName()
        ];
    }
    
    public static function unAuthUser()
    {
        session_destroy();
    }
    
    public static function getAuthUser()
    {
        $userManager = new UserManager();
        return array_key_exists( 'user' , $_SESSION ) ? $userManager->find( $_SESSION['user']['id'] ) : false;
    }
    
    public static function isAuthenticated()
    {
        return array_key_exists('user', $_SESSION);
    }
    
    public static function isAdmin()
    {
        return array_key_exists('user', $_SESSION) && $_SESSION['user']['role'] === 'admin';
    }
}