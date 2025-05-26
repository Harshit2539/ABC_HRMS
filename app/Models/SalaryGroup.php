<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class SalaryGroup extends Model
{
    use HasFactory;
 
    protected $table = "salary_group";
    protected $guarded = [];
 
 
    public function  components(){
        return $this->hasMany(SalaryGroupComponents::class,'salary_group_id','id')->select('id','salary_component_id','salary_group_id');
    }
 
 
 
 
}