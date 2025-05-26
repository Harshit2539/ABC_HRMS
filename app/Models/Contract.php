<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'Vendor_name',
        'subject',
        'value',
        'type',
        'start_date',
        'due_date',
        'description',
    ];
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }}
