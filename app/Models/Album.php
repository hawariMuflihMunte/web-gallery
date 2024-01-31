<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'album';
    protected $primaryKey = ' AlbumID';
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
}
