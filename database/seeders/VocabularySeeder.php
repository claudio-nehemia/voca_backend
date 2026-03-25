<?php

namespace Database\Seeders;

use App\Models\VocabularyTheme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VocabularySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            'Greetings and Introductions',
            'Daily Activities',
            'Food & Beverages',
            'Travel and Transportation',
            'Health and Wellness',
            'Education and Learning',
            'Work and Career',
            'Technology and Media',
            'Nature and Environment',
        ];

        foreach ($themes as $themeName) {
            $theme = VocabularyTheme::firstOrCreate([
                'name' => $themeName,
            ]);

            // Add dummy vocabularies for first few themes
            if ($theme->name === 'Greetings and Introductions' && $theme->vocabularies()->count() == 0) {
                $theme->vocabularies()->createMany([
                    [
                        'title' => 'Greet',
                        'goals' => 'To welcome someone',
                        'description' => 'Welcome, Salute',
                        'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3', // Placeholder
                        'point' => 10,
                    ],
                    [
                        'title' => 'Introduce',
                        'goals' => 'To present someone',
                        'description' => 'Present, Acquaint',
                        'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3', // Placeholder
                        'point' => 10,
                    ],
                    [
                        'title' => 'Pleasure',
                        'goals' => 'A feeling of happiness',
                        'description' => 'Delight, Joy',
                        'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3', // Placeholder
                        'point' => 15,
                    ],
                    [
                        'title' => 'Acquaintance',
                        'goals' => 'A person one knows slightly',
                        'description' => 'Contact, Associate',
                        'audio_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3', // Placeholder
                        'point' => 20,
                    ],
                ]);
                
                // Add more to reach ~25 as in SS
                for ($i = 5; $i <= 25; $i++) {
                    $theme->vocabularies()->create([
                        'title' => 'Word ' . $i,
                        'goals' => 'Sample goal for word ' . $i,
                        'description' => 'Synonym ' . $i,
                        'point' => 5,
                    ]);
                }
            } else if($theme->vocabularies()->count() == 0) {
                 // Add at least one to others to show counts correctly
                 $theme->vocabularies()->create([
                    'title' => 'Example Word',
                    'goals' => 'Sample goal',
                    'description' => 'Sample description',
                    'point' => 5,
                ]);
            }
        }
    }
}
