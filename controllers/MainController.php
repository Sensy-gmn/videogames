<?php

namespace Controllers;

use Core\AbstractController;
use Managers\GameManager;

class MainController extends AbstractController
{
    public function showHome()
    {
        $this->render('home.phtml');
    }
    
    public function showGames()
    {
        $gameManager = new GameManager();
        
        $this->render('games.phtml', [
            'games' => $gameManager->findAll()
        ]);
    }
    
    public function searchGame()
    {
        $searchQuery = $_GET['searchQuery'];
        
        $gameManager = new GameManager();
        
        $searchResults = $gameManager->findSearchGame( $searchQuery );
        
        header('Content-Type: application/json');
        echo json_encode( $searchResults );
    }
}