<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vocabulary;
use App\Models\VocabularyTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VocabularyController extends Controller
{
    public function themes(Request $request)
    {
        $user = $request->user();
        
        $themes = VocabularyTheme::withCount('vocabularies')
            ->get()
            ->map(function ($theme) use ($user) {
                $totalWords = $theme->vocabularies_count;
                $doneWords = DB::table('vocabulary_user')
                    ->join('vocabularies', 'vocabulary_user.vocabulary_id', '=', 'vocabularies.id')
                    ->where('vocabulary_user.user_id', $user->id)
                    ->where('vocabularies.theme_id', $theme->id)
                    ->count();
                
                return [
                    'id' => $theme->id,
                    'name' => $theme->name,
                    'total_words' => $totalWords,
                    'done_words' => $doneWords,
                    'progress_percentage' => $totalWords > 0 ? round(($doneWords / $totalWords) * 100) : 0,
                ];
            });

        return response()->json([
            'themes' => $themes,
            'summary' => [
                'total_units' => $themes->count(),
                'total_words' => $themes->sum('total_words'),
            ]
        ]);
    }

    public function vocabularies(Request $request, $themeId)
    {
        $user = $request->user();
        $theme = VocabularyTheme::findOrFail($themeId);
        
        $vocabularies = Vocabulary::where('theme_id', $themeId)
            ->get()
            ->map(function ($vocab) use ($user) {
                $isLearned = DB::table('vocabulary_user')
                    ->where('user_id', $user->id)
                    ->where('vocabulary_id', $vocab->id)
                    ->exists();
                
                return [
                    'id' => $vocab->id,
                    'title' => $vocab->title,
                    'description' => $vocab->description,
                    'goals' => $vocab->goals,
                    'audio_url' => $vocab->audio_url,
                    'point' => $vocab->point,
                    'is_learned' => $isLearned,
                ];
            });

        return response()->json([
            'theme_name' => $theme->name,
            'vocabularies' => $vocabularies
        ]);
    }

    public function complete(Request $request, $vocabId)
    {
        $user = $request->user();
        $vocab = Vocabulary::findOrFail($vocabId);

        // Check if already learned
        $exists = DB::table('vocabulary_user')
            ->where('user_id', $user->id)
            ->where('vocabulary_id', $vocabId)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Already learned'], 200);
        }

        DB::transaction(function () use ($user, $vocab) {
            $user->vocabularies()->attach($vocab->id);
            $user->increment('score', $vocab->point);
            $user->increment('total_words_learned');
        });

        return response()->json([
            'message' => 'Vocabulary completed!',
            'new_score' => $user->fresh()->score
        ]);
    }

    public function continueLearning(Request $request)
    {
        $user = $request->user();

        // Get themes from recently learned vocabularies
        $recentThemeIds = DB::table('vocabulary_user')
            ->join('vocabularies', 'vocabulary_user.vocabulary_id', '=', 'vocabularies.id')
            ->where('vocabulary_user.user_id', $user->id)
            ->orderBy('vocabulary_user.updated_at', 'desc')
            ->pluck('vocabularies.theme_id')
            ->unique()
            ->take(3);

        if ($recentThemeIds->isEmpty()) {
            // If no history, just take recent themes from VocabularyTheme
            $recentThemeIds = VocabularyTheme::orderBy('created_at', 'desc')->pluck('id')->take(3);
        }

        $themes = VocabularyTheme::whereIn('id', $recentThemeIds)
            ->withCount('vocabularies')
            ->get()
            ->map(function ($theme) use ($user) {
                $totalWords = $theme->vocabularies_count;
                $doneWords = DB::table('vocabulary_user')
                    ->join('vocabularies', 'vocabulary_user.vocabulary_id', '=', 'vocabularies.id')
                    ->where('vocabulary_user.user_id', $user->id)
                    ->where('vocabularies.theme_id', $theme->id)
                    ->count();
                
                return [
                    'id' => $theme->id,
                    'name' => $theme->name,
                    'total_words' => $totalWords,
                    'done_words' => $doneWords,
                    'progress' => $totalWords > 0 ? round(($doneWords / $totalWords) * 100) : 0,
                ];
            });

        return response()->json([
            'themes' => $themes
        ]);
    }
}
