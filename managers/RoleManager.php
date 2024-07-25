<?php

namespace Managers;

use Core\AbstractManager;
use Entities\Role;

class RoleManager extends AbstractManager
{
    public function __construct()
    {
        $this->model = Role::class;
    }
}