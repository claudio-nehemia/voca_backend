<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    protected $fillable = [
        'theme_id',
        'title',
        'description',
        'goals',
        'audio_url',
        'point',
    ];

    public function theme()
    {
        return $this->belongsTo(VocabularyTheme::class, 'theme_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'vocabulary_user')->withTimestamps();
    }
}


