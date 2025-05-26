<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 
 
class Training extends Model
{
    use HasFactory;
    protected $fillable = [
        'training_type',
        'trainer_id',
        'department_id',
        'employee_id',
        'start_date',
        'end_date',
        'description',
        'status',
    ];
 
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
 
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
 
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
 
 
    public function multiple_employee()
    {
        return $this->hasMany(EmployeeTraining::class,'training_id');
    }
}