<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public $guarded = [];

    public $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function testimonials()
    {
        return $this->belongsToMany(Testimonial::class, 'history_testimonial');
    }
}
