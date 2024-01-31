<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'UserID';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Username',
        'Password',
        'Email',
        'NamaLengkap',
        'Alamat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function album(): HasMany
    {
        return $this->hasMany(Album::class, 'AlbumID');
    }

    public function foto(): HasMany
    {
        return $this->hasMany(Foto::class, 'FotoID');
    }

    public function komentarfoto(): HasMany
    {
        return $this->hasMany(KomentarFoto::class, 'KomentarID');
    }

    public function likefoto(): HasMany
    {
        return $this->hasMany(LikeFoto::class, 'LikeID');
    }
}
