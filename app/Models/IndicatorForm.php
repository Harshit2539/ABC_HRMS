<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class IndicatorForm extends Model
{
    use HasFactory;
 
    protected $table = 'indicator_form';
 
 
    public function department()
    {
        return $this->belongsTo(department::class ,  'department_id','id')->select('id','department');
    }
 
    public function job_title()
    {
        return $this->belongsTo(JobTitles::class ,  'job_title_id','id')->select('id','department_id','name');
    }
 
    public function title()
    {
        return $this->hasMany(IndicatorTitle::class ,  'indicator_form_id','id');
    }
 
 
}
 