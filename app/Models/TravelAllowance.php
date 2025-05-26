<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelAllowance extends Model
{
    use HasFactory;
    protected $table = "travel_allowances";
    protected $guarded = [];
    public $timestamps=false;
}
