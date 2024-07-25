<?php

namespace Core;

class FlashBag
{
    public static function set( string $message, string $type ) : void
    {
        $_SESSION['flashbag'] = [
            'message' => $message,  
            'type' => $type  
        ];
    }
    
    public static function get() : array
    {
        if( !empty( $_SESSION['flashbag'] ) && is_array( $_SESSION['flashbag'] ) )
        {
            $return = $_SESSION['flashbag'];
            unset( $_SESSION['flashbag'] );
            return $return;
        }
        return [];
    }
}