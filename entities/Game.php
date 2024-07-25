<?php

namespace Entities;

class Game 
{
    private int $id;
    private string $title;
    private int $released_year;
    private ?string $jacket;
    private int $category_id;
    private int $plateform_id;
    public int $user_id;
    private int $game_id; // Added this line to define the game_id property

    public function getId() : int
    {
        return $this->id;
    }
    
    public function setId( int $id ) : void
    {
        $this->id = $id;
    }
    
    public function getTitle() : string
    {
        return $this->title;
    }
    
    public function setTitle( string $title ) : void
    {
        $this->title = $title;
    }
    
    public function getReleaseYear() : int
    {
        return $this->released_year;
    }
    
    public function setReleaseYear( int $released_year ) : void
    {
        $this->released_year = $released_year;
    }
    
    public function getJacket() : ?string
    {
        return $this->jacket;
    }
    
    public function setJacket( ?string $jacket ) : void
    {
        $this->jacket = $jacket;
    }
    
    public function getCategoryId() : int
    {
        return $this->category_id;
    }
    
    public function setCategoryId( int $category_id ) : void
    {
        $this->category_id = $category_id;
    }
    
    public function getPlateformId() : int
    {
        return $this->plateform_id;
    }
    
    public function setPlateformId( int $plateform_id ) : void
    {
        $this->plateform_id = $plateform_id;
    }

    public function getGameId() : int
    {
        return $this->game_id;
    }

    public function setGameId(int $game_id) : void
    {
        $this->game_id = $game_id;
    }
}