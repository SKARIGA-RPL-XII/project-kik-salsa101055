<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id_task';

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'reward',
        'status',
        'created_by_admin_id',
        'attachment', // ← TAMBAHAN
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_admin_id', 'id_user');
    }

    public function taskUsers()
    {
        return $this->hasMany(TaskUser::class, 'id_task', 'id_task');
    }

    public function assignedUsers()
    {
        return $this->belongsToMany(
            User::class,
            'task_user',
            'id_task',
            'id_user',
            'id_task',
            'id_user'
        )->withPivot('status', 'completed_at')
         ->withTimestamps();
    }

    public function reports()
    {
        return $this->hasMany(TaskReport::class, 'id_task', 'id_task');
    }
}