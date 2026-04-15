<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskReport extends Model
{
    protected $table = 'task_reports';
    protected $primaryKey = 'id_report';

    protected $fillable = [
        'id_task',
        'id_user',
        'report_text',
        'report_file',
        'status',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'id_task', 'id_task');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}