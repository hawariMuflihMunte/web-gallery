<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Photo extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'photos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    /** TODO: [PHOTO] Implement photo model relationship
     *
     * - Update album model relatiionship key
     * - Update user model relatiionship key
     * - Update comment model relatiionship key
     * - Update like model relatiionship key
     * */


    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'AlbumID');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(KomentarFoto::class, 'FotoID');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(LikeFoto::class, 'FotoID');
    }
}
