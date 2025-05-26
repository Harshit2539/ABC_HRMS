<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $table = "projects";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'client_id');
    }}
