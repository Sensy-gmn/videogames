<?php

function assets( $path )
{
    return './public/assets/' . $path;
}

function routePath( string $routeName, $data = [] )
{
    $queryString = '';
    if( count( $data ) > 0 )
    {
        foreach( $data as $key => $value )
        {
            $queryString .= "&$key=$value";
        }
    }
    return "index.php?route=" . $routeName . $queryString;
}

function dd( $var )
{
    var_dump( $var );
    die();
}