<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Services\AchievementService;

class MobileAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if ($user->role !== 'user') {
            return response()->json([
                'message' => 'Unauthorized. Only users can login here.'
            ], 403);
        }

        if (!$user->is_active) {
            return response()->json([
                'message' => 'Your account is inactive. Please contact support.'
            ], 403);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'score' => $user->score ?? 0,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
    public function user(Request $request)
    {
        $user = $request->user();
        
        // Count totals
        $totalVocab = \App\Models\Vocabulary::count();
        $totalWriting = \App\Models\Writing::count();
        $totalSpeaking = \App\Models\Speaking::count();
        $totalActivities = $totalVocab + $totalWriting + $totalSpeaking;

        // Count completed
        $completedVocab = DB::table('vocabulary_user')->where('user_id', $user->id)->count();
        $completedWriting = DB::table('writing_user')->where('user_id', $user->id)->count();
        $completedSpeaking = DB::table('speaking_user')->where('user_id', $user->id)->count();
        $completedActivities = $completedVocab + $completedWriting + $completedSpeaking;

        $progressPercentage = $totalActivities > 0 ? round(($completedActivities / $totalActivities) * 100) : 0;

        // Rank Calculation
        $rank = User::where('role', 'user')
            ->where('is_active', true)
            ->where('score', '>', $user->score)
            ->count() + 1;

        $topStudents = User::where('role', 'user')
            ->where('is_active', true)
            ->orderBy('score', 'desc')
            ->limit(3)
            ->get(['id', 'name', 'class', 'score']);

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'class' => $user->class ?? 'Class 10-A',
                'score' => (int) ($user->score ?? 0),
                'progress_percentage' => (int) $progressPercentage,
                'rank' => $rank,
                'words_learned' => $completedVocab,
                'total_words' => $totalVocab,
                'exercises_done' => $completedWriting + $completedSpeaking,
            ],
            'top_students' => $topStudents,
            'user_stats' => [
                'speaking_points'   => (int) DB::table('speaking_user')->where('user_id', $user->id)->sum('point_earned'),
                'writing_points'    => (int) DB::table('writing_user')->where('user_id', $user->id)->sum('point_earned'),
                'vocabulary_points' => (int) DB::table('vocabulary_user')->join('vocabularies', 'vocabulary_user.vocabulary_id', '=', 'vocabularies.id')->sum('vocabularies.point'),
                'total_points'      => (int) ($user->score ?? 0),
            ],
            'achievements' => \App\Models\Achievement::all()->map(function($a) use ($user) {
                $isUnlocked = $user->achievements()->where('achievement_id', $a->id)->exists();
                
                // Calculate progress
                $progress = 0;
                switch ($a->type) {
                    case 'speaking':   $progress = (int) DB::table('speaking_user')->where('user_id', $user->id)->sum('point_earned'); break;
                    case 'writing':    $progress = (int) DB::table('writing_user')->where('user_id', $user->id)->sum('point_earned'); break;
                    case 'vocabulary': $progress = (int) DB::table('vocabulary_user')->join('vocabularies', 'vocabulary_user.vocabulary_id', '=', 'vocabularies.id')->sum('vocabularies.point'); break;
                    case 'total':      $progress = (int) ($user->score ?? 0); break;
                }

                return [
                    'id' => $a->id,
                    'name' => $a->name,
                    'description' => $a->description,
                    'icon' => $a->icon,
                    'type' => $a->type,
                    'required_points' => $a->required_points,
                    'is_unlocked' => $isUnlocked,
                    'current_progress' => min($progress, $a->required_points),
                    'unlocked_at' => $isUnlocked ? $user->achievements()->where('achievement_id', $a->id)->first()->pivot->unlocked_at : null,
                ];
            }),
            'newly_unlocked' => AchievementService::syncAchievements($user),
        ]);
    }

    public function leaderboard()
    {
        $students = User::where('role', 'user')
            ->where('is_active', true)
            ->orderBy('score', 'desc')
            ->get(['id', 'name', 'class', 'score']);

        return response()->json([
            'leaderboard' => $students
        ]);
    }
}
