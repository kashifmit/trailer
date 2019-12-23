<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name','email', 'password', 'organization_id', 'Role_id', 'verification_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function organizations()
    {
        return $this->belongsTo('App\OrganizationModel', 'organization_id', 'organizationId');
    }

    public function getOrganizationName($field = '')
    {
        $organizations = $this->organizations()->first();
        if (null === $organizations) {
            $organizations = $this->organizations()->first();
        }
        if (null !== $organizations) {
            if (!empty($field))
                return $organizations->$field;
            else
                return $organizations;
        }
    }

    public function roles()
    {
        return $this->belongsTo('App\RoleModel', 'Role_id', 'roleId');
    }

    public function getRoleName($field = '')
    {
        $roles = $this->roles()->first();
        if (null === $roles) {
            $roles = $this->roles()->first();
        }
        if (null !== $roles) {
            if (!empty($field))
                return $roles->$field;
            else
                return $roles;
        }
    }
}
