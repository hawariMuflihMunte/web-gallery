<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Album extends Model
{
    use HasFactory, HasSlug;

    protected $table = "albums";
    protected $primaryKey = "id";
    public $timestamps = true;

    protected $guarded = ["id"];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom("title")
            ->saveSlugsTo("slug");
    }

    public function getRouteKeyName(): string
    {
        return "slug";
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class, 'album_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
