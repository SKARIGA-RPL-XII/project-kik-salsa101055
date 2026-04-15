<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';  // ← PASTIKAN INI ADA!
    
    protected $fillable = [
        'name', 'email', 'password',
        'id_role', 'id_level', 'exp',
        'coin', 'photo_profile', 'status',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    public function level()
    {
        return $this->belongsTo(UserLevel::class, 'id_level', 'id_level');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user', 'id_user', 'id_task', 'id_user', 'id_task')
                    ->withPivot('status', 'completed_at')
                    ->withTimestamps();
    }
}