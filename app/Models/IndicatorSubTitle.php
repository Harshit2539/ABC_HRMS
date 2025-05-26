<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class IndicatorSubTitle extends Model
{
    use HasFactory;
    protected $table = 'indicator_sub_title';
 
 
    public function title(){
 
        return $this->belongsTo(IndicatorTitle::class,'title_id','id');
    }
 
}
 
 