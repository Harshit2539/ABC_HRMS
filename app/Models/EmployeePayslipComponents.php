<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class EmployeePayslipComponents extends Model
{
    use HasFactory;
    protected $table = 'employee_payslip_components';
    public $timestamps=false;
    protected $guarded = [];

    public function component_detail()
    {
        return $this->belongsTo(SalaryComponent::class, 'component_id', 'id');
    }
}
