<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $appends = [
        'image',
    ];

    public function getImageAttribute()
    {
        return $this->logo ? \Illuminate\Support\Facades\Storage::disk('public')->url($this->logo) : '';
    }
}
