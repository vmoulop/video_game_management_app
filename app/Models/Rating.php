<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_game_id',
        'rating',
        'review',
    ];
    
    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the VideoGames model
    public function videoGames()
    {
        return $this->belongsTo(VideoGames::class);
    }
}
