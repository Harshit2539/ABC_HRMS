<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyStructure extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function parent_detail()
    {
        return $this->belongsTo(CompanyStructure::class, 'parent');
    }

    public function country_detail()
    {
        return $this->belongsTo(Countries::class, 'country');
    }
}
