<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class PerformanceAppraisal extends Model
{
    use HasFactory;
 
    protected $table = "performance_appraisal";
    protected $guarded = [];
 
 
    public function  department(){
        return $this->belongsTo(department::class,'department_id','id');
    }
 
    public function job_title(){
 
        return $this->belongsTo(JobTitles::class,'job_title_id','id');
    }
 
    public function employee(){
 
        return $this->belongsTo(Employee::class,'supervisor_emp_id','id');
    }
 
 
    public function rated_employee(){
 
        return $this->belongsTo(Employee::class,'rated_employee_id','id');
    }
 
    public function appraisal_rating(){
 
        return $this->hasMany(PerformanceAppraisalRating::class,'performance_appraisal_id','id');
    }
 
         
 
    public function indicator(){
           
        return $this->belongsTo(PerformaceIndicator::class,'performance_indicator_id','id');
 
 
    }
 
   
}
 