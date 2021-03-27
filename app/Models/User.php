<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Order;
use App\Models\Car;
use App\Models\Permission;
use App\Models\Report;
use App\Models\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function hasPermission(Permission $permission)
    {
        $check = optional(optional($this->role)->permissions)->contains($permission);

        return $check;
    }
}
