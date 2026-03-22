<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VocabularyTheme extends Model
{
    protected $fillable = [
        'name',
    ];

    public function vocabularies()
    {
        return $this->hasMany(Vocabulary::class, 'theme_id');
    }
}
