<?php

namespace App\Services;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AchievementService
{
    public static function syncAchievements(User $user)
    {
        $achievements = Achievement::all();
        
        $stats = [
            'speaking'   => (int) DB::table('speaking_user')->where('user_id', $user->id)->sum('point_earned'),
            'writing'    => (int) DB::table('writing_user')->where('user_id', $user->id)->sum('point_earned'),
            'vocabulary' => (int) DB::table('vocabulary_user')->join('vocabularies', 'vocabulary_user.vocabulary_id', '=', 'vocabularies.id')->sum('vocabularies.point'),
            'total'      => (int) ($user->score ?? 0),
        ];

        $newlyUnlocked = [];
        $existingAchievementIds = $user->achievements()->pluck('achievement_id')->toArray();

        foreach ($achievements as $achievement) {
            if (in_array($achievement->id, $existingAchievementIds)) {
                continue;
            }

            $currentVal = $stats[$achievement->type] ?? 0;
            if ($currentVal >= $achievement->required_points) {
                $user->achievements()->attach($achievement->id, ['unlocked_at' => now()]);
                $newlyUnlocked[] = $achievement;
            }
        }

        return $newlyUnlocked;
    }
}
