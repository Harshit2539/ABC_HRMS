<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class PerformanceIndicatorRating extends Model
{
    use HasFactory;
 
    protected $table = "performance_indicator_rating";
    protected $guarded = [];
 
 
    public function title()
{
    return $this->belongsTo(IndicatorTitle::class, 'title_id');
}
 
public function sub_title()
{
    return $this->belongsTo(IndicatorSubTitle::class, 'sub_title_id');
}
 
 
 
}