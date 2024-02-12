<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    protected $table = 'album';
    protected $primaryKey = 'AlbumID';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'NamaAlbum',
        'Deskripsi',
        'TanggalDibuat',
    ];

    public function foto(): HasMany
    {
        return $this->hasMany(Foto::class, 'FotoID');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
