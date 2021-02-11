<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_per', 'per_id', 'role_id');
    }
}
