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

    protected $table = "user";
    protected $primaryKey = "UserID";
    public $timestamps = false;

    protected $guarded = ["UserID"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["Password"];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "Password" => "hashed",
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom("Username")
            ->saveSlugsTo("slug");
    }

    public function getRouteKeyName(): string
    {
        return "slug";
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class, "UserID");
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Foto::class, "UserID");
    }

    public function comments(): HasMany
    {
        return $this->hasMany(KomentarFoto::class, "UserID");
    }

    public function likes(): HasMany
    {
        return $this->hasMany(LikeFoto::class, "UserID");
    }
}
