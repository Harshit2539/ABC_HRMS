<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveDetail extends Model
{
    use HasFactory;
    protected $table = "leave_details";
    protected $guarded = [];    

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id')->select(['id', 'name']);;
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
