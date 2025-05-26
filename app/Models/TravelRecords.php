<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelRecords extends Model
{
    use HasFactory;
    protected $table = "travel_records";
    protected $guarded = [];
    
    public function employee(){
        return $this->belongsTo(User::class,'employee_id');

    }
    public function currency(){
        return $this->belongsTo(CurrencyTypes::class,'currency_id');
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
    protected $fillable = [
        'type', 
        'purpose',
        'travel_from',
        'travel_to',
        'travel_date',
        'return_date',
        'funding',
        'currency_id',
        'employee_id',
        // 'status',
        'notes',
        'attachment',
        'approver1',
        'approver2',
        'approver3'
    ];}
