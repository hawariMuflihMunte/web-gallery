<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LikeFoto extends Model
{
    protected $table = 'likefoto';
	protected $primaryKey = 'LikeID';
	public $timestamps = false;

	/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
	    'TanggalLike'
    ];
}
