<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class EmployeeTraining extends Model
{
    use HasFactory;
 
    protected $table = 'employees_training';
    protected $guarded = [];
 
    public $timestamps=false;


    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
 
}
 