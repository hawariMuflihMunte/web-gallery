<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Foto extends Model
{
    protected $table = 'foto';
    protected $primaryKey = 'FotoID';
    protected $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'JudulFoto',
        'DeskripsiFoto',
        'TanggalUnggah',
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'AlbumID');
    }

    public function komentarfoto(): HasMany
    {
        return $this->hasMany(KomentarFoto::class, 'KomentarID');
    }

    public function likefoto(): HasMany
    {
        return $this->hasMany(LikeFoto::class, 'LikeID');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
