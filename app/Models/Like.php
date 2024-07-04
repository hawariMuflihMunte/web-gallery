<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Like extends Model
{
    use HasFactory, HasSlug;

    protected $table = "likes";
    protected $primaryKey = "id";
    public $timestamps = true;

    protected $guarded = ["id"];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('created_at')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function photo(): BelongsTo
    {
        return $this->belongsTo(Photo::class, 'id', 'photo_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "id", "user_id");
    }
}
