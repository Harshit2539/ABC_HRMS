<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverTimeRequests extends Model
{
    use HasFactory;
    protected $table = "overtime_requests";
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(User::class,'employee_id');
    }
    public function project()
    {
        return $this->belongsTo(Projects::class,'project_id');
    }
    public function category()
    {
        return $this->belongsTo(OverTimeCategories::class,'category_id');
    }
}
