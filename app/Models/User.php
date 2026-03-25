<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'role',
        'profile_picture',
        'total_words_learned',
        'score',
        'exersises_completed',
        'class',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function vocabularies()
    {
        return $this->belongsToMany(Vocabulary::class, 'vocabulary_user')->withTimestamps();
    }

    public function writings()
    {
        return $this->belongsToMany(Writing::class, 'writing_user')
            ->withPivot('answer', 'point_earned')
            ->withTimestamps();
    }

    public function speakings()
    {
        return $this->belongsToMany(Speaking::class, 'speaking_user')
            ->withPivot('audio_url', 'point_earned')
            ->withTimestamps();
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'achievement_user')
            ->withPivot('unlocked_at')
            ->withTimestamps();
    }
}




