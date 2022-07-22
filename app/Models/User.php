<?php

namespace App\Models;

use App\Modules\Admin\Models\Branch\Branch;
use App\Modules\Admin\Models\Notification\Notification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $guard_name = 'web';
    protected $table = 'users';
    protected $guard = 'web';
    protected $guarded = [];
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
    public function branch(){
        return $this->belongsToMany(Branch::class , 'branch_user' , 'user_id' , 'branch_id');
    }

    // public function notification(){
    //     return $this->hasMany(Notification::class , 'id');
    // }
}
