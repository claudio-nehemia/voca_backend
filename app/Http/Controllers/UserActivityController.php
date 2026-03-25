<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vocabulary;
use App\Models\Writing;
use App\Models\Speaking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserActivityController extends Controller
{
    public function index(Request $request)
    {
        $viewType = $request->get('view', 'user'); 
        $users = User::where('role', 'user')->orderBy('name')->get();
        
        $selectedUserId = $request->get('user_id');
        $selectedActivity = $request->get('activity', 'writing'); 
        
        $data = [];

        if ($viewType === 'user' && $selectedUserId) {
            $user = User::findOrFail($selectedUserId);
            $user->total_words_learned = DB::table('vocabulary_user')->where('user_id', $selectedUserId)->count();
            
            // Vocab Activity (Last 5)
            $vocabProgress = DB::table('vocabulary_user')
                ->join('vocabularies', 'vocabulary_user.vocabulary_id', '=', 'vocabularies.id')
                ->where('vocabulary_user.user_id', $selectedUserId)
                ->select('vocabularies.title', 'vocabulary_user.created_at as completed_at')
                ->orderBy('vocabulary_user.created_at', 'desc')
                ->limit(5)
                ->get();
                
            // Writing Activity (Last 5)
            $writingProgress = DB::table('writing_user')
                ->join('writings', 'writing_user.writing_id', '=', 'writings.id')
                ->where('writing_user.user_id', $selectedUserId)
                ->select('writings.title', 'writings.instruction', 'writing_user.answer', 'writing_user.point_earned', 'writing_user.created_at as submitted_at')
                ->orderBy('writing_user.created_at', 'desc')
                ->limit(5)
                ->get();

            // Speaking Activity (Last 5)
            $speakingProgress = DB::table('speaking_user')
                ->join('speakings', 'speaking_user.speaking_id', '=', 'speakings.id')
                ->where('speaking_user.user_id', $selectedUserId)
                ->select('speakings.title', 'speakings.instruction', 'speaking_user.audio_url', 'speaking_user.point_earned', 'speaking_user.created_at as submitted_at')
                ->orderBy('speaking_user.created_at', 'desc')
                ->limit(5)
                ->get();
                
            $data = [
                'user' => $user,
                'vocab' => $vocabProgress,
                'writing' => $writingProgress,
                'speaking' => $speakingProgress,
            ];
        } elseif ($viewType === 'activity') {
            if ($selectedActivity === 'writing') {
                $activities = DB::table('writing_user')
                    ->join('users', 'writing_user.user_id', '=', 'users.id')
                    ->join('writings', 'writing_user.writing_id', '=', 'writings.id')
                    ->select('users.id as user_id', 'users.name as user_name', 'writings.title as activity_title', 'writings.instruction', 'writing_user.answer', 'writing_user.created_at')
                    ->orderBy('writing_user.created_at', 'desc')
                    ->paginate(10);
            } elseif ($selectedActivity === 'speaking') {
                $activities = DB::table('speaking_user')
                    ->join('users', 'speaking_user.user_id', '=', 'users.id')
                    ->join('speakings', 'speaking_user.speaking_id', '=', 'speakings.id')
                    ->select('users.id as user_id', 'users.name as user_name', 'speakings.title as activity_title', 'speakings.instruction', 'speaking_user.audio_url', 'speaking_user.created_at')
                    ->orderBy('speaking_user.created_at', 'desc')
                    ->paginate(10);
            } else {
                $activities = DB::table('vocabulary_user')
                    ->join('users', 'vocabulary_user.user_id', '=', 'users.id')
                    ->join('vocabularies', 'vocabulary_user.vocabulary_id', '=', 'vocabularies.id')
                    ->select('users.id as user_id', 'users.name as user_name', 'vocabularies.title as activity_title', 'vocabulary_user.created_at')
                    ->orderBy('vocabulary_user.created_at', 'desc')
                    ->paginate(10);
            }
            $data = [
                'activities' => $activities,
                'selected_activity' => $selectedActivity
            ];
        }

        return view('admin.user_activity.index', compact('viewType', 'users', 'selectedUserId', 'data'));
    }

    public function userWritingDetails(User $user)
    {
        $activities = DB::table('writing_user')
            ->join('writings', 'writing_user.writing_id', '=', 'writings.id')
            ->where('writing_user.user_id', $user->id)
            ->select('writings.title', 'writings.instruction', 'writing_user.answer', 'writing_user.point_earned', 'writing_user.created_at as submitted_at')
            ->orderBy('writing_user.created_at', 'desc')
            ->paginate(10);

        return view('admin.user_activity.writing_details', compact('user', 'activities'));
    }

    public function userVocabDetails(User $user)
    {
        $activities = DB::table('vocabulary_user')
            ->join('vocabularies', 'vocabulary_user.vocabulary_id', '=', 'vocabularies.id')
            ->where('vocabulary_user.user_id', $user->id)
            ->select('vocabularies.title', 'vocabulary_user.created_at as completed_at')
            ->orderBy('vocabulary_user.created_at', 'desc')
            ->paginate(10);

        return view('admin.user_activity.vocab_details', compact('user', 'activities'));
    }

    public function userSpeakingDetails(User $user)
    {
        $activities = DB::table('speaking_user')
            ->join('speakings', 'speaking_user.speaking_id', '=', 'speakings.id')
            ->where('speaking_user.user_id', $user->id)
            ->select('speakings.title', 'speakings.instruction', 'speaking_user.audio_url', 'speaking_user.point_earned', 'speaking_user.created_at as submitted_at')
            ->orderBy('speaking_user.created_at', 'desc')
            ->paginate(10);

        return view('admin.user_activity.speaking_details', compact('user', 'activities'));
    }
}
