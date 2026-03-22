<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
        'type',
        'required_points',
    ];

    /**
     * Human-readable label for the type.
     */
    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'speaking'   => 'Speaking',
            'writing'    => 'Writing',
            'vocabulary' => 'Vocabulary',
            'total'      => 'Total Score',
            default      => ucfirst($this->type),
        };
    }

    /**
     * Color class per type for the badge.
     */
    public function getTypeColorAttribute(): string
    {
        return match($this->type) {
            'speaking'   => 'type-speaking',
            'writing'    => 'type-writing',
            'vocabulary' => 'type-vocabulary',
            'total'      => 'type-total',
            default      => 'type-total',
        };
    }
}
