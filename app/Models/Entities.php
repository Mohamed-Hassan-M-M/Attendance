<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entities extends Model
{
    protected $table = 'entities';

    protected $fillable = [
        'id', 'name', 'name_ar', 'address', 'address_ar', 'phone', 'email'
    ];

    public function department(){
        return $this->hasMany(Departments::class, 'entity_id');
    }
    public function employee(){
        return $this->hasMany(Employees::class, 'entity_id');
    }

}
