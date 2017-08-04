<?php

namespace App;

use App\Thread;
use Illuminate\Notifications\Notifiable;
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
     * get the rout key name for laravel
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * get the rout key name for laravel
     * @return string
     */
    public function threads()
    {
        return $this->hasMany(Thread::class)->latest();
    }
}
