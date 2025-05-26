<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayGrade extends Model
{
    use HasFactory;
    protected $table = 'pay_grades';
    public $timestamps=false;
    protected $guarded = [];
}
