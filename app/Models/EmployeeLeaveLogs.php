<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveLogs extends Model
{
    use HasFactory;

    protected $table = 'employee_leave_logs';
 
    protected $guarded = false;

}
