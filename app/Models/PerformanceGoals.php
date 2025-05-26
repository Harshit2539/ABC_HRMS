<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class PerformanceGoals extends Model
{
    use HasFactory;
 
    protected $table ='performance_goals';
 
    protected $fillable =[
        'goal_type',
        'start_date',
        'end_date',
        'subject',
        'target_achievement',
        'description'
       
    ];
 
 
 
    public function  department(){
        return $this->belongsTo(department::class,'department_id','id');
    }
 
    public function job_title(){
 
        return $this->belongsTo(JobTitles::class,'job_title_id','id');
    }
 
 
}
 
 