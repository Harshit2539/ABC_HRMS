<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitles extends Model
{
    use HasFactory;
    protected $table = 'job_titles';
    public $timestamps=false;
    protected $guarded = [];



    public function employees()
    {
        return $this->hasMany(Employee::class, 'job_title', 'id');
    }
}
