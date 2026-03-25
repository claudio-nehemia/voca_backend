<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $achievements = [
            // Total Score
            [
                'name' => 'Beginner Explorer',
                'description' => 'Mencapai total skor 100 poin',
                'icon' => '🌱',
                'type' => 'total',
                'required_points' => 100,
            ],
            [
                'name' => 'Advanced Learner',
                'description' => 'Mencapai total skor 500 poin',
                'icon' => '🚀',
                'type' => 'total',
                'required_points' => 500,
            ],
            [
                'name' => 'Elite Student',
                'description' => 'Mencapai total skor 1000 poin',
                'icon' => '🏆',
                'type' => 'total',
                'required_points' => 1000,
            ],

            // Vocabulary
            [
                'name' => 'Word Seeker',
                'description' => 'Dapatkan total 25 poin dari mempelajari kosakata',
                'icon' => '🔍',
                'type' => 'vocabulary',
                'required_points' => 25,
            ],
            [
                'name' => 'Vocabulary Master',
                'description' => 'Dapatkan total 100 poin dari mempelajari kosakata',
                'icon' => '📚',
                'type' => 'vocabulary',
                'required_points' => 100,
            ],

            // Writing
            [
                'name' => 'Aspiring Writer',
                'description' => 'Dapatkan total 25 poin dari latihan menulis',
                'icon' => '📝',
                'type' => 'writing',
                'required_points' => 25,
            ],
            [
                'name' => 'Script Master',
                'description' => 'Dapatkan total 100 poin dari latihan menulis',
                'icon' => '✍️',
                'type' => 'writing',
                'required_points' => 100,
            ],

            // Speaking
            [
                'name' => 'Chatty Learner',
                'description' => 'Dapatkan total 25 poin dari latihan berbicara',
                'icon' => '🗣️',
                'type' => 'speaking',
                'required_points' => 25,
            ],
            [
                'name' => 'Fluent Speaker',
                'description' => 'Dapatkan total 100 poin dari latihan berbicara',
                'icon' => '🎤',
                'type' => 'speaking',
                'required_points' => 100,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::updateOrCreate(
                ['name' => $achievement['name']],
                $achievement
            );
        }
    }
}
