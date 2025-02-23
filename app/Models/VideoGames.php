<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGames extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'release_date',
        'genre',
        'user_id',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Rating model
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
