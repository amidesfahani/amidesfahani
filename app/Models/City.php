<?php

namespace App\Models;

use App\Helpers\CountryTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    use CountryTrait;

    public $timestamps = false;

    public $guarded = [];

    public function getCountryNameAttribute()
    {
        return $this->CountryName();
    }
}
