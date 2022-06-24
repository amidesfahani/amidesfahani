<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imageable extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $appends = [
        'image_url',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? \Illuminate\Support\Facades\Storage::disk('public')->url($this->image) : '';
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
