<?php

namespace App\Http\Controllers;

use App\Models\VideoGames;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VideoGamesController extends Controller
{
    // Apply authentication middleware
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // View all video games
    public function index()
    {
        $games = VideoGames::all();
        return response()->json($games);
    }

    // View a single video game
    public function show($id)
    {
        $game = VideoGames::findOrFail($id);
        return response()->json($game);
    }

    // Add a new video game
    public function store(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'genre' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the new video game
        $game = VideoGames::create([
            'title' => $request->title,
            'description' => $request->description,
            'release_date' => $request->release_date,
            'genre' => $request->genre,
            'user_id' => auth()->id(), // Associate the game with the authenticated user
        ]);

        return response()->json([
            'message' => 'Game was created successfully!',
            'game'=>$game
        
        ], 200);
    }

    // Edit an existing video game
    public function update(Request $request, $id)
    {
        $game = VideoGames::findOrFail($id);

        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'genre' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $game->update([
            'title' => $request->title,
            'description' => $request->description,
            'release_date' => $request->release_date,
            'genre' => $request->genre,
        ]);

        return response()->json($game);
    }

    // Delete a video game
    public function destroy($id)
    {
        $game = VideoGames::findOrFail($id);
        
        // Check if the authenticated user is either an admin or the owner of the video game
        if (auth()->user()->role === 'admin' || $game->user_id === auth()->id()) {
            $game->delete();
            return response()->json([
                'message' => 'Video game deleted successfully.'
            ]);
        }

        return response()->json([
            'message' => 'You are not authorized to delete this game.'
        ], 403);  // Forbidden
    }
    
    // Show the dashboard with a list of games (return view)
    public function indexDashView(Request $request)
    {

        $user = $request->user();
        $genre = $request->genre;
        $sort = $request->sort;
       
        $games = $user->videoGames()
            ->when($sort, function($query) use($sort){
                $query->orderBy('release_date', $sortOrder);
            })
            ->when($genre, function($query) use($genre){
                $query->where('genre', $genre);
            })->get();
        
        return view('dashboard', ['games' => $games]);
    }

    // Show the dashboard with a list of games (return json)
    public function indexDashJson(Request $request)
    {

        $user = $request->user();
        $genre = $request->genre;
        $sort = $request->sort;
       
        $games = $user->videoGames()
            ->when($sort, function($query) use($sort){
                $query->orderBy('release_date', $sortOrder);
            })
            ->when($genre, function($query) use($genre){
                $query->where('genre', $genre);
            })->get();
        
        return response()->json($games);
    }
}
