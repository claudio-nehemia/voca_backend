<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSpeaking extends Model
{
    protected $fillable = [
        'name',
    ];

    public function speakings()
    {
        return $this->hasMany(Speaking::class, 'jenis_speaking_id');
    }
}
