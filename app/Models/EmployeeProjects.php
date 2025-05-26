<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProjects extends Model
{
    use HasFactory;
    protected $table = "employee_projects";
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Projects::class,'project_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'emp_id');
    }}
