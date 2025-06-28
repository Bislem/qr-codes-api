<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'fullName',
        'email',
        'phone',
        'links',
        'isActive',
        'password',
        'avatar',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'links' => 'array',
        'isActive' => 'boolean',
        'password' => 'hashed',
    ];
}
