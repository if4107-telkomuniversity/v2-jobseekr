<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'remember_token',
        'is_deleted',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function detail()
    {
        switch ($this->hasOne('App\Jobseeker', 'user_id')->toSql()) {
            case 'jobseeker':
                return $this->hasOne('App\Jobseeker', 'user_id');
            case 'recruiter':
                return $this->hasOne('App\Recruiter', 'user_id');
            default:
                return null;
        }
    }
}
