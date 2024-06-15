<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;

    protected $table = "album";
    protected $primaryKey = "AlbumID";
    public $timestamps = false;

    protected $guarded = ['AlbumID'];

    public function foto(): HasMany
    {
        return $this->hasMany(Foto::class, "AlbumID");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "UserID");
    }
}
