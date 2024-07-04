<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $guarded = ["id"];


    /** TODO: [PHOTO] Implement photo model relationship
     *
     * - Update photo model relatiionship key
     * - Update user model relatiionship key
     * */

    public function photo(): BelongsTo
    {
        return $this->belongsTo(Foto::class, "FotoID");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "UserID");
    }
}
