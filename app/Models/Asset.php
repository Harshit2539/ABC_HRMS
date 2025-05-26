<?php
 
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Asset extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'asset_type_id', 'location_id', 'serial_number', 'description', 'status', 'image'];
 
    public function index()
{
    $asset_types = AssetType::all(); // Fetch all asset types from the model
 
    return view('asset.index', compact('asset_types'));
}
public function location()
{
    return $this->belongsTo(Location::class, 'location_id');
}
 
   public function user()
   {
       return $this->belongsTo(User::class, 'user_id');
   }
   public function lentTo()
{
    return $this->hasOne(LentAsset::class, 'asset_id')->latest(); // Fetch the latest lent record
}
public function assetType()
{
    return $this->belongsTo(AssetType::class, 'asset_type_id');
}
 
 
 
}