<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePayslip extends Model
{
    use HasFactory;

    protected $table = 'employee_payslip';
    public $timestamps=false;
    protected $guarded = [];

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }


    public function employee_payslip_component()
    {
        return $this->hasMany(EmployeePayslipComponents::class, 'employee_payslip_id', 'id');
    }
}
