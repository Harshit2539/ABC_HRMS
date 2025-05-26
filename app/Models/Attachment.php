<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['contract_id', 'file_name', 'file_path', 'file_type', 'file_size'];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
