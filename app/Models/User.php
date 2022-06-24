<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'mobile',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'name', 'age', 'avatar_url', 'name', 'fullname', 'name_fa', 'fullname_fa'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'birthdate' => 'date',
    ];

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? \Illuminate\Support\Facades\Storage::disk('public')->url($this->avatar) : '';
    }

    public function getAgeAttribute()
    {
        if ($this->birthdate)
        {
            return $this->birthdate->diff()->y;
        }
    }

    public function getFullnameFaAttribute()
    {
        return $this->name_fa;
    }

    public function getNameFaAttribute()
    {
        return $this->firstname_fa . ' ' . $this->lastname_fa;
    }

    public function getFullnameAttribute()
    {
        return $this->name;
    }

    public function getNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getGenderValueAttribute()
    {
        if ($this->gender == 'male')
        {
            return 1;
        }
        if ($this->gender == 'female')
        {
            return 2;
        }
        return 0;
    }

    public function isSuperAdmin()
    {
        return $this->super_admin;
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function canAccessNova()
    {
        return $this->isAdmin() || $this->isSuperAdmin();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class)->where('language', app()->getLocale());
    }

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
