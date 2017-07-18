<?php

namespace App\Models\Traits;

use App\Models\Role;

trait UserRoles
{
    /**
     * Get the roles
     * @return \Eloquent
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
    }

    public function getRolesList()
    {
        return $this->roles()->get()->pluck('id', 'id')->toArray();
    }

    public function getRolesStringAttribute()
    {
        return implode(', ', $this->roles()->get()->pluck('name', 'id')->toArray());
    }

    /**
     * If User is given role type
     * @param string $role
     * @return bool
     */
    public function hasRole($role = 'web')
    {
        return ($this->roles()->where('keyword', $role)->first() ? true : false);
    }

    /**
     * Query Scope
     * Get all the users that has the role
     * @param $query
     * @param $role
     * @return mixed
     */
    public function scopeWhereRole($query, $role)
    {
        return $query->whereHas('roles', function ($query) use ($role) {
            return $query->where('keyword', $role);
        });
    }

    /**
     * Attach a Role to the user from the role slug
     * @param $roleSlug
     * @return mixed
     */
    public function attachRole($roleSlug)
    {
        // add dealer role to user
        $role = Role::where('keyword', $roleSlug)->first();
        $this->roles()->attach([$role->id]);

        return $this->roles;
    }

    /**
     * Sync the roles
     * @param      $roles
     * @param bool $detach
     * @return mixed
     */
    public function syncRoles($roles, $detach = false)
    {
        foreach ($roles as $k => $slug) {
            // add dealer role to user
            $role = Role::where('keyword', $slug)->first();
            $this->roles()->syncWithoutDetaching([$role->id]);
        }

        return $this->roles;
    }

    /**
     * Remove a role from the user
     * @param $roleSlug
     * @return mixed
     */
    public function detachRole($roleSlug)
    {
        // add dealer role to user
        $role = Role::where('keyword', $roleSlug)->first();
        $this->roles()->detach([$role->id]);

        return $this->roles;
    }
}