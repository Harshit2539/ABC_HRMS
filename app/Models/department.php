<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Department extends Model
{
    use HasFactory;
    protected $fillable = ['deleted_at'];
    public function trainings()
    {
        return $this->hasMany(Training::class, 'department_id');
    }
 
    public function employees()
    {
        return $this->hasMany(Employee::class, 'department', 'id');
    }
}