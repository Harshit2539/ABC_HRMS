<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class SalaryComponent extends Model
{
    use HasFactory;
 
    protected $table = "salary_component";
    protected $guarded = [];
 
    protected $appends = ['component_value_type_label'];
 
    const VALUE_TYPE_FIXED = 1;
    const VALUE_TYPE_VARIABLE = 2;
    const VALUE_TYPE_BASIC_PERCENT = 3;
    const VALUE_TYPE_CTC_PERCENT = 4;
 
    public static $valueTypeLabels = [
        self::VALUE_TYPE_FIXED => 'Fixed',
        self::VALUE_TYPE_VARIABLE => 'Variable',
        self::VALUE_TYPE_BASIC_PERCENT => 'Basic Percent',
        self::VALUE_TYPE_CTC_PERCENT => 'CTC Percent',
    ];
 
    public function getComponentValueTypeLabelAttribute()
    {
        return self::$valueTypeLabels[$this->component_value_type] ?? 'Unknown';
    }
 
 
}