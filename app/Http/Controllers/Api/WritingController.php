<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Writing;
use App\Models\WritingTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WritingController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        $writings = Writing::with('writingTheme')
            ->get()
            ->map(function ($writing) use ($user) {
                $submission = DB::table('writing_user')
                    ->where('user_id', $user->id)
                    ->where('writing_id', $writing->id)
                    ->first();
                    
                return [
                    'id' => $writing->id,
                    'theme_name' => $writing->writingTheme ? $writing->writingTheme->name : 'General',
                    'title' => $writing->title,
                    'instruction' => $writing->instruction,
                    'point' => $writing->point,
                    'is_done' => $submission !== null,
                    'answer' => $submission ? $submission->answer : null,
                ];
            });
            
        return response()->json([
            'writing_count' => $writings->count(),
            'exercises' => $writings
        ]);
    }

    public function show($id, Request $request)
    {
        $user = $request->user();
        $writing = Writing::with('writingTheme')->findOrFail($id);
        
        $submission = DB::table('writing_user')
            ->where('user_id', $user->id)
            ->where('writing_id', $id)
            ->first();

        return response()->json([
            'id' => $writing->id,
            'theme_name' => $writing->writingTheme ? $writing->writingTheme->name : 'General',
            'title' => $writing->title,
            'instruction' => $writing->instruction,
            'point' => $writing->point,
            'is_done' => $submission !== null,
            'answer' => $submission ? $submission->answer : null,
        ]);
    }

    public function submit(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        $user = $request->user();
        $writing = Writing::findOrFail($id);

        $exists = DB::table('writing_user')
            ->where('user_id', $user->id)
            ->where('writing_id', $id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Exercise already submitted'], 400);
        }

        DB::transaction(function () use ($user, $writing, $request) {
            $user->writings()->attach($writing->id, [
                'answer' => $request->answer,
                'point_earned' => $writing->point,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $user->increment('score', $writing->point);
        });

        return response()->json([
            'message' => 'Answer submitted successfully!',
            'new_score' => $user->fresh()->score,
        ]);
    }
}
