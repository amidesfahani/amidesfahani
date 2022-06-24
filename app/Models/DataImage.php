<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataImage extends Model
{
    use HasFactory;

    public $guarded = [];

    public $timestamps = false;

    protected $appends = [
        'image',
    ];

    public function getImageAttribute()
    {
        return $this->value ? \Illuminate\Support\Facades\Storage::disk('public')->url($this->value) : '';
    }
}
