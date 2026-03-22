<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Writing extends Model
{
    protected $fillable = [
        'writing_theme_id',
        'title',
        'instruction',
        'point',
    ];

    public function writingTheme()
    {
        return $this->belongsTo(WritingTheme::class, 'writing_theme_id');
    }
}
