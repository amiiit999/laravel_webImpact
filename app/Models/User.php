<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UsersOnlineTrait;
class User extends Authenticatable

{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'department_id','role', 'email', 'password', 'avatar', 'status',
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


    public function isAdministrator()
    {
        return $this->attributes['role'] == 'administrator' ? true : false;
    }

    public function isAdmin()
    {
        return $this->attributes['role'] == 'admin' ? true : false;
    }

    public function isUser()
    {
        return $this->attributes['role'] == 'user' ? true : false;
    }
}
