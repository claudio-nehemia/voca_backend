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

        foreach ($themes as $theme) {
            VocabularyTheme::firstOrCreate([
                'name' => $theme,
            ]);
        }
    }
}
