<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;


    protected $guarded = false;


    public function user()
    {
        return $this->belongsTo(User::class,'employee_id');
    }

    public function department_name()
    {
        return $this->belongsTo(department::class,'department');
    }

    public function approver1User()
    {
        return $this->belongsTo(User::class, 'approver1');
    }
     
    public function approver2User()
    {
        return $this->belongsTo(User::class, 'approver2');
    }
     
    public function approver3User()
    {
        return $this->belongsTo(User::class, 'approver3');
    }

  

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }


  

    public function reimbursements()
    {
        return $this->hasMany(Reimbursement::class, 'employee_id');
    }
    public function nationality()
    {
        return $this->belongsTo(nationalities::class, 'nationality', 'id');
    }
 
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country', 'id');
    }
    public function job_title()
    {
        return $this->belongsTo(JobTitles::class, 'job_title', 'id');
    }
  
     public function job_title_details()
    {
        return $this->belongsTo(JobTitles::class, 'job_title', 'id');
    }
}
