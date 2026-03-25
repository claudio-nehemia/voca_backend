<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Writing;
use App\Models\Speaking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExerciseController extends Controller
{
    public function stats(Request $request)
    {
        $user = $request->user();

        // Writing Stats
        $totalWritingCount = Writing::count();
        $totalWritingPoints = (int) Writing::sum('point');
        $completedWritingCount = DB::table('writing_user')->where('user_id', $user->id)->count();
        $earnedWritingPoints = (int) DB::table('writing_user')->where('user_id', $user->id)->sum('point_earned');

        // Speaking Stats
        $totalSpeakingCount = Speaking::count();
        $totalSpeakingPoints = (int) Speaking::sum('point');
        $completedSpeakingCount = DB::table('speaking_user')->where('user_id', $user->id)->count();
        $earnedSpeakingPoints = (int) DB::table('speaking_user')->where('user_id', $user->id)->sum('point_earned');

        return response()->json([
            'writing' => [
                'total_exercises' => $totalWritingCount,
                'total_points' => $totalWritingPoints,
                'completed_count' => $completedWritingCount,
                'earned_points' => $earnedWritingPoints,
            ],
            'speaking' => [
                'total_exercises' => $totalSpeakingCount,
                'total_points' => $totalSpeakingPoints,
                'completed_count' => $completedSpeakingCount,
                'earned_points' => $earnedSpeakingPoints,
            ],
            'stats' => [
                'total_completed' => $completedWritingCount + $completedSpeakingCount,
                'total_exercises' => $totalWritingCount + $totalSpeakingCount,
                'total_points_earned' => $earnedWritingPoints + $earnedSpeakingPoints,
            ]
        ]);
    }
}
