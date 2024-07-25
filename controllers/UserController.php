<?php

namespace Controllers;

use Core\AbstractController;
use Services\AuthService;

class UserController extends AbstractController
{
    public function showProfile()
    {
        try
        {
            $user = AuthService::getAuthUser();
            
            if( !$user )
            {
                throw new \Exception("You have to be authenticated to see your profile page.");
            }
            
            $this->render('profile.phtml', [
                'user' => $user
            ]);
        }
        catch( \Exception $e )
        {
            FlashBag::set( $e->getMessage() , 'error' );
            $this->redirectTo('login');
        }
    }
}