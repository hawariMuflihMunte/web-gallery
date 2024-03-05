<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KomentarFoto extends Model
{
  protected $table = "komentarfoto";
  protected $primaryKey = "KomentarID";
  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ["FotoID", "UserID", "IsiKomentar", "TanggalKomentar"];

  public function foto(): BelongsTo
  {
    return $this->belongsTo(Foto::class, "FotoID");
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, "UserID");
  }
}
