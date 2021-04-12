<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $table = 'deductions';

    protected $fillable = [
        'id', 'employee_id', 'day', 'amount', 'created_at'
    ];
}
