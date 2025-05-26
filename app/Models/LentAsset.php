<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class LentAsset extends Model
{
    use HasFactory;
    protected $table = 'lent_assets';
    protected $fillable = [
        'asset_id',
        'user_id',
        'lend_date',
        'return_date',
        'actual_return_date',
        'notes',
    ];
 
 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
 
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
 
    public function returnUser()
    {
        return $this->belongsTo(User::class, 'return_user_id');
    }
    public function returnBy()
    {
        return $this->belongsTo(User::class, 'return_by');
    }
}
 