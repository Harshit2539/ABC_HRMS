<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class AssetReturn extends Model
{
    use HasFactory;
 
    protected $table = 'asset_returns';
 
    protected $guarded = false;
 
public function user() {
    return $this->belongsTo(User::class, 'user_id');
}
 
public function returnUser() {
    return $this->belongsTo(User::class, 'return_user_id');
}
 
public function asset() {
    return $this->belongsTo(Asset::class, 'asset_id');
}
 
public function returnBy() {
    return $this->belongsTo(User::class, 'return_by');
}
 
}
 
 
 