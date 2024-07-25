<?php

namespace Managers;

use Core\AbstractManager;
use Entities\Game;

class GameManager extends AbstractManager
{
    public function __construct()
    {
        $this->model = Game::class;
    }
    
    public function findUserGames( $userid )
    {
        return $this->fetchAll(
            "SELECT * FROM game LEFT JOIN library ON library.game_id = game.id WHERE library.user_id = :user_id",
            [':user_id' => $userid]
        );
    }
    
    public function findSearchGame( $searchQuery )
    {
        $query = $this->getDb()->prepare("SELECT game.* FROM game WHERE title LIKE CONCAT('%', :searchQuery, '%')");
        $query->execute([ 
            ':searchQuery' => $searchQuery
        ]);
        return $query->fetchAll( \PDO::FETCH_ASSOC );
    }
    
    public function createGame( $game )
    {
        $query = $this->getDb()->prepare("INSERT INTO game (title, released_year, jacket, category_id, plateform_id) VALUES (:title, :released_year, :jacket, :category_id, :plateform_id)");
        $query->execute([
            'title' => $game['title'],
            'released_year' => $game['released_year'],
            'jacket' => $game['jacket'],
            'category_id' => $game['category_id'],
            'plateform_id' => $game['plateform_id'],
        ]);
    }
}