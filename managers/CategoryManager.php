<?php

namespace Managers;

use Core\AbstractManager;
use Entities\Category;

class CategoryManager extends AbstractManager
{
    public function __construct()
    {
        $this->model = Category::class;
    }
}