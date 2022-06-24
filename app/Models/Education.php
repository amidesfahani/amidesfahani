<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    public $guarded = [];

    public $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function documents()
    {
        return $this->morphMany(Imageable::class, 'imageable');
    }

    public function latestDocument()
    {
        return $this->morphOne(Imageable::class, 'imageable')->latestOfMany();
    }

    public function oldestDocument()
    {
        return $this->morphOne(Imageable::class, 'imageable')->oldestOfMany();
    }
}
