<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class PerformaceIndicator extends Model
{
    use HasFactory;
   
    protected $table = "performance_indicator";
    protected $guarded = [];
 
 
    public function  department(){
        return $this->belongsTo(department::class,'department_id','id');
    }
 
    public function job_title(){
 
        return $this->belongsTo(JobTitles::class,'job_title_id','id');
    }
 
    public function employee(){
 
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
 
    public function indicator_rating(){
 
        return $this->hasMany(PerformanceIndicatorRating::class,'performance_indicator_id','id');
    }
 
 
   
}