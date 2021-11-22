<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemporaryUrl extends Model
{
    use SoftDeletes;

    public const UPDATED_AT = null;
    /**
     * @var string[]
     */
    protected $fillable = [
        'slug',
        'file_id'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'file_id',
        'id',
        'updated_at'
    ];


    /**
     * @return BelongsTo
     */
    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
