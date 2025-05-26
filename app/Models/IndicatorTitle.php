<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class IndicatorTitle extends Model
{
    use HasFactory;
 
    protected $table = 'indicator_title';
 
 
 
    public function sub_title(){
 
        return $this->hasMany(IndicatorSubTitle::class,'title_id','id');
    }
   
 
}
 