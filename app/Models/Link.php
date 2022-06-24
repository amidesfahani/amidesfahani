<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $appends = [
        'url'
    ];

    public function getUrlAttribute()
    {
        if ($this->pattern && $this->account)
        {
            return str_replace("{account}", $this->account, $this->pattern);
        }
        return $this->pattern;
    }
}
