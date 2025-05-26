<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class EmployeeSalaryComponents extends Model
{
    use HasFactory;
 
    protected $table = "employee_salary_components";
    protected $guarded = [];
}