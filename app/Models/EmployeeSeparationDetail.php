<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
 
 
class EmployeeSeparationDetail extends Model
{
    protected $table = 'employee_separation_details';
       use SoftDeletes;
         protected $dates = ['deleted_at'];
    protected $fillable = [
        'employee_id',
        'separation_mode_id',
        'resignation_submitted_date',
        'reason_for_leaving',
        'notice_required',
        'resignation_notice_period',
        'shortfall_notice',
        'tentative_leaving_date',
        'remark',
    ];
 
    // Optional: if you're not using timestamps
    public $timestamps = false;
 
    public function employee()
{
    return $this->belongsTo(Employee::class, 'employee_id');
}
 
public function separationMode()
{
    return $this->belongsTo(EmployeeSeperationMode::class, 'separation_mode_id');
}
}
 