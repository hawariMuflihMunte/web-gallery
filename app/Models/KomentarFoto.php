<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarFoto extends Model
{
    protected $table = 'komentarfoto';
    protected $primaryKey = 'KomentarID';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IsiKomentar',
        'TanggalKomentar',
    ];
}
