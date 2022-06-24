<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    public $guarded = [];

    public $casts = [
        'order_date' => 'date',
        'final_date' => 'date'
    ];

    protected $appends = [
        'image_url', 'slug'
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image)
        {
            return $this->image ? \Illuminate\Support\Facades\Storage::disk('public')->url($this->image) : '';
        }

        if ($this->cover) {
            return $this->cover->image_url;
        }
    }

    public function getSlugAttribute()
    {
        return $this->title ? Str::slug($this->title) : '';
    }

    public function images()
    {
        return $this->morphMany(Imageable::class, 'imageable');
    }

    public function latestImage()
    {
        return $this->morphOne(Imageable::class, 'imageable')->latestOfMany();
    }

    public function oldestImage()
    {
        return $this->morphOne(Imageable::class, 'imageable')->oldestOfMany();
    }

    public function cover()
    {
        return $this->morphOne(Imageable::class, 'imageable')->where('cover', 1)->inRandomOrder();
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tag');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_project');
    }

    public function testimonials()
    {
        return $this->belongsToMany(Testimonial::class, 'project_testimonial');
    }
}
