<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryGroupComponents extends Model
{
    use HasFactory;
    protected $table = "salary_group_components";
    protected $guarded = [];


    public function  component_details(){
        return $this->belongsTo(SalaryComponent::class,'salary_component_id','id');
    }

    public function  salary_component_detail(){
        return $this->hasOne(SalaryComponent::class,'id','salary_component_id');
    }
}
