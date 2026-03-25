<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speaking extends Model
{
    protected $fillable = [
        'jenis_speaking_id',
        'title',
        'instruction',
        'point',
    ];

    public function jenisSpeaking()
    {
        return $this->belongsTo(JenisSpeaking::class, 'jenis_speaking_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'speaking_user')
            ->withPivot('audio_url', 'point_earned')
            ->withTimestamps();
    }
}

