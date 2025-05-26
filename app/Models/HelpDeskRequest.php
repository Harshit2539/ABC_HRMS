<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class HelpDeskRequest extends Model
{
    use HasFactory;
 
    protected $table = 'help_desk_request';
 
    protected $guarded = false;
 
 
    public function cc()
    {
        return $this->hasMany(ccEmployees::class ,  'help_request_id','id');
    }
 
}