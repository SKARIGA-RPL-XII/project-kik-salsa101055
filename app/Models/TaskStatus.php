<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $table = 'task_status';
    protected $primaryKey = 'id_status';

    protected $fillable = ['status_name', 'status_color'];
}