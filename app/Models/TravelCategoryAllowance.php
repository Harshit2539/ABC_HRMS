<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelCategoryAllowance extends Model
{
    use HasFactory;

    protected $table = "travel_category_allowances";
    protected $guarded = [];
    public $timestamps=false;

    public function travel_allowance()
    {
        return $this->hasOne(TravelAllowance::class,'id','travel_allowance_id');
    }

    public function travel_division()
    {
        return $this->hasOne(Division::class,'id','division_id');
    }
    public function travel_category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
}
