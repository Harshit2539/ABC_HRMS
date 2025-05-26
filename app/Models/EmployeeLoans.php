<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLoans extends Model
{
    use HasFactory;
    protected $table = "employee_loans";
    protected $guarded = [];
    public $timestamps=false;

    public function employee()
    {
        return $this->belongsTo(User::class,'employee_id');
    }
    public function loan()
    {
        return $this->belongsTo(LoanTypes::class,'loan_id');
    }
    public function currency()
    {
        return $this->belongsTo(CurrencyTypes::class,'currency_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'employee_id', 'id')->select(['id', 'name']);;
    }

    public function approver1(){
        return $this->belongsTo(User::class, 'approver1', 'id')->select(['id', 'name']);;
    }
    public function approver2(){
        return $this->belongsTo(User::class, 'approver2', 'id')->select(['id', 'name']);;
    }
    public function approver3(){
        return $this->belongsTo(User::class, 'approver3', 'id')->select(['id', 'name']);;
    }


}
