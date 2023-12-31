<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'master.users';
    protected $fillable = [
        'role_id',
        'username',
        'name',
        'email',
        'password',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'role_name'
    ];

    public $searchable = [
        'name',
        'username',
        'email'
    ];

    public function Role()
    {
        return $this->belongsTo(Roles::class);
    }

    public function getRoleNameAttribute()
    {
        return $this->Role ? $this->Role->name : '';
    }
}
