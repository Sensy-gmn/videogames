<?php

namespace Managers;

use Core\AbstractManager;
use Entities\Plateform;

class PlateformManager extends AbstractManager
{
    public function __construct()
    {
        $this->model = Plateform::class;
    }
}