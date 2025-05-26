<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
 
class ccEmployees extends Model
{
    use HasFactory;
   
    protected $table = 'cc_employees';
 
    protected $gaurded= false;
 
    public function helpRequests()
    {
        return $this->belongsTo(HelpDeskRequest::class ,'help_request_id' );
    }
 
 
 
}
 
 
 