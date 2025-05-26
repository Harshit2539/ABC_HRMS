<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'policy_id',
        'policy_name',
        'uploaded_file_path',
    ];
}
