<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'id', 'firstname', 'firstname_ar', 'lastname', 'lastname_ar', 'mobile', 'barcode', 'address', 'address_ar', 'email', 'department_id', 'entity_id',
    ];

    public function entity(){
        return $this->belongsTo(Entities::class, 'entity_id');
    }
    public function department(){
        return $this->belongsTo(Departments::class, 'department_id');
    }
}
