<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    protected $primaryKey = 'FotoID';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'JudulFoto',
        'DeskripsiFoto',
        'TanggalDiunggah',
    ];
}
