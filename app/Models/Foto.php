<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Foto extends Model
{
    use HasSlug;

    protected $table = "foto";
    protected $primaryKey = "FotoID";
    public $timestamps = false;

    protected $guarded = ['FotoID'];

    /**
	 * Get the options for generating the slug.
	 */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('JudulFoto')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, "AlbumID");
    }

    public function komentarfoto(): HasMany
    {
        return $this->hasMany(KomentarFoto::class, "FotoID");
    }

    public function likefoto(): HasMany
    {
        return $this->hasMany(LikeFoto::class, "FotoID");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "UserID");
    }
}
