<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    use HasFactory;
    protected $table = "provinces";
    protected $guarded = [];

    public function countary()
    {
        return $this->belongsTo(Countries::class,'countary_id');
    }
}
