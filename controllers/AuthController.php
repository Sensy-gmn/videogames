<?php

namespace Controllers;

use Core\AbstractController;
use Core\FlashBag;
use Managers\UserManager;
use Services\AuthService;

class AuthController extends AbstractController
{
    public function showLogin() 
    {
        $this->render('login.phtml');
    }
    
    public function checkLogin()
    {
        try
        {
            
            if(
                !isset( $_POST['username'] ) || empty($_POST['username'] ) ||
                !isset( $_POST['password'] ) || empty($_POST['password'] )
            )
            {
                throw new \Exception("All fields are mandatory.");
            }
            
            $userManager = new UserManager();
            
            $user = $userManager->findByUsername( $_POST['username'] );
            
            if( !$user || !password_verify( $_POST['password'], $user->getPassword() ) )
            {
                throw new \Exception("Invalid credentials");
            }
            
            AuthService::authUser( $user );
            
            FlashBag::set( 'Authentication successful, welcome back ' . $user->getUsername(), 'succes');
            
            $this->redirectTo( 'profile' );
        }
        catch(\Exception $e)
        {
            FlashBag::set( $e->getMessage(), 'error');
            $this->redirectTo('login');
        }
    }
    
    public function logout()
    {
        AuthService::unAuthUser();
        
        FlashBag::set('Logout successful.', 'succes');
        
        $this->redirectTo('home');
    }
}