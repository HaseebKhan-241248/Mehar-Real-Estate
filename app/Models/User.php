<?php

namespace App\Models;

use App\Models\Permission\Permission;
use App\Models\Projects\Project;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = [
        'updated_at',
        'created_at',
        'email_verified_at',
        'two_factor_expires_at',
    ];
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role',
        'cnic',
        'status',
        'created_by',
        'project_id',
        'email_verified_at',
        'two_factor_code',
        'two_factor_expires_at',
        'photo',
    ];

    public function generateTwoFactorCode()
{

    $this->timestamps = false;
    $this->two_factor_code = rand(100000, 999999);
    $this->two_factor_expires_at = now()->addMinutes(10);
    $this->save();
//    dd($this);
        return $this;
}
public function resetTwoFactorCode()
{
    $this->timestamps = false;
    $this->two_factor_code = null;
    $this->two_factor_expires_at = null;
    $this->save();
}
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function UserName() {
        return $this->hasOne(User::class, 'id','created_by' );
    }
    public function Project_Name() {
        return $this->hasOne(Project::class, 'id','project_id' );
    }
    public function UserPermissions() {
        return $this->hasOne(Permission::class );
    }

    public function has()
    {
        return $this->hasOne(Permission::class,'user_id', 'id' );
    }
}
