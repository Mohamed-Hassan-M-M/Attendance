<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = [
        'id', 'entity_id', 'department_id', 'employee_id', 'status', 'created_at'
    ];
}
