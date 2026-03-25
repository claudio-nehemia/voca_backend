<?php

namespace Database\Seeders;

use App\Models\Writing;
use App\Models\WritingTheme;
use Illuminate\Database\Seeder;

class WritingSeeder extends Seeder
{
    public function run(): void
    {
        $guided = WritingTheme::create(['name' => 'Guided Task']);
        $independent = WritingTheme::create(['name' => 'Independent Task']);
        $experience = WritingTheme::create(['name' => 'Experience Task']);

        Writing::create([
            'writing_theme_id' => $guided->id,
            'title' => 'Complete the Sentence',
            'instruction' => 'Fill in the blank with the correct word: "She _______ (greet/greeting) her neighbor every morning."',
            'point' => 10,
        ]);

        Writing::create([
            'writing_theme_id' => $guided->id,
            'title' => 'Error Correction',
            'instruction' => 'Find and correct the error: "I was very pleasure to meet you yesterday."',
            'point' => 15,
        ]);

        Writing::create([
            'writing_theme_id' => $independent->id,
            'title' => 'Paragraph Rewriting',
            'instruction' => 'Rewrite the following paragraph using more formal vocabulary: "I think that this app is really good because it helps me learn new words fast."',
            'point' => 25,
        ]);

        Writing::create([
            'writing_theme_id' => $experience->id,
            'title' => 'Complete the Story',
            'instruction' => 'Continue the story in 2-3 sentences: "One day, when I was walking home from work, I saw something very unusual..." ',
            'point' => 30,
        ]);
    }
}
