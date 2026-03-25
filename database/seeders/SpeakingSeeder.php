<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSpeaking;
use App\Models\Speaking;

class SpeakingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $basic = JenisSpeaking::create(['name' => 'Basic Q&A']);
        $discussion = JenisSpeaking::create(['name' => 'Discussion']);
        $story = JenisSpeaking::create(['name' => 'Story & Scene']);

        Speaking::create([
            'jenis_speaking_id' => $basic->id,
            'title' => 'Self Introduction',
            'instruction' => 'Record a 30-second introduction about yourself. Include your name, age, hobbies, and what you want to learn.',
            'point' => 20,
        ]);

        Speaking::create([
            'jenis_speaking_id' => $basic->id,
            'title' => 'Daily Routine',
            'instruction' => 'Describe your typical weekday from morning to night. Mention what you do for breakfast, lunch, and dinner.',
            'point' => 25,
        ]);

        Speaking::create([
            'jenis_speaking_id' => $discussion->id,
            'title' => 'Opinion Sharing',
            'instruction' => 'Express your opinion: "Is learning English important for your career?". Give at least two reasons.',
            'point' => 30,
        ]);

        Speaking::create([
            'jenis_speaking_id' => $story->id,
            'title' => 'Picture Description',
            'instruction' => 'Describe a picture of a busy city park. What are the people doing? What is the weather like?',
            'point' => 35,
        ]);
    }
}
