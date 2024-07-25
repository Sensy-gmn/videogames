<?php

// $router->addRoute( 'nomDeLaRoute', 'ControllerName::methodeName' );

// PUBLIC ROUTES
$router->addRoute( 'home', 'MainController::showHome' );
$router->addRoute( 'games', 'MainController::showGames' );
// AUTH ROUTES
$router->addRoute( 'login', 'AuthController::showLogin' );
$router->addRoute( 'checkLogin', 'AuthController::checkLogin' );
$router->addRoute( 'logout', 'AuthController::logout' );
// USER ROUTES
$router->addRoute('profile', 'UserController::showProfile');
// API JSON
$router->addRoute('search', 'MainController::searchGame');
// ADMIN ROUTES
$router->addRoute('newGame', 'AdminController::showNewGame');
$router->addRoute('addGame', 'AdminController::addGame');