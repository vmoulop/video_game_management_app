<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\VideoGames;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    // Store a new rating and review
    public function store(Request $request, $id)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the game by ID
        $game = VideoGames::findOrFail($id);

        // Create a new rating and review
        Rating::create([
            'user_id' => Auth::id(),
            'video_game_id' => $game->id,
            'rating' => $request->input('rating'),
            'review' => $request->input('review'),
        ]);

        return response()->json([
            'message' => 'Rating and review submitted successfully!'
        ], 201);
    }
}
