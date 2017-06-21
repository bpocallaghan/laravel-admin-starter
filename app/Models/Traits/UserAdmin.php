<?php

namespace App\Models\Traits;

use App\Models\Role;

trait UserAdmin
{
    /**
     * If User is admin
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole(Role::$ADMIN);
    }

    /**
     * If User is admin
     * @return bool
     */
    public function isDeveloper()
    {
        return $this->hasRole(Role::$DEVELOPER);
    }
}