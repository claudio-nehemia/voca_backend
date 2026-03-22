<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WritingTheme extends Model
{
    protected $fillable = [
        'name',
    ];

    public function writings()
    {
        return $this->hasMany(Writing::class, 'writing_theme_id');
    }
}
