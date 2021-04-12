<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Working_Hours extends Model
{
    protected $table = 'working__hours';

    protected $fillable = [
        'id', 'day_off', 'to', 'from', 'day', 'employees_id', 'department_id', 'entity_id',
    ];

    public function entity(){
        return $this->belongsTo(Entities::class, 'entity_id');
    }
    public function department(){
        return $this->belongsTo(Departments::class, 'department_id');
    }

}
