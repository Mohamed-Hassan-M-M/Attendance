<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'id', 'name', 'name_ar', 'entity_id'
    ];

    public function entity(){
        return $this->belongsTo(Entities::class, 'entity_id');
    }

    public function employee(){
        return $this->hasMany(Employees::class, 'department_id');
    }

}
