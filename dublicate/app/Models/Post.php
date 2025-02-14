<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment; 
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'user_name', 'posting', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    public function reactions()
{
    return $this->hasMany(Reaction::class);
}
public function comments()
{
    return $this->hasMany(Comment::class);
}
}
