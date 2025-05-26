<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDetails extends Model
{
    use HasFactory;
    protected $table = "client_details";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'client_id');
    }}
