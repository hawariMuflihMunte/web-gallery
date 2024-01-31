<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function foto(): BelongsTo
	{
		return $this->belongsTo(Foto::class, 'FotoID');
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class, 'UserID');
	}
}
