<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class User extends Authenticatable
{
    use HasFactory, HasRoles, HasSlug;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id'];
    protected $hidden = ['password'];
    protected $casts = [
        'password' => 'hashed',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('username')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class, 'id', 'user_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class, 'id', 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'id', 'user_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'id', 'user_id');
    }
}
