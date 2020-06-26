<?php

namespace App\Models\Auth\Traits\Method;

/**
 * Trait RoleMethod.
 */
trait RoleMethod
{
    /**
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->name === config('access.users.admin_role');
    }

    public function isPengajar()
    {
        return $this->name === config('access.users.pengajar_role');
    }
}
