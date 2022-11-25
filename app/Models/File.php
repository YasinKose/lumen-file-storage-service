<?php

namespace App\Models;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use GeneratesUuid;

    /**
     * @var string[]
     */
    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'original_name',
        'mime_type',
        'extension',
        'file_path',
        'domain_id',
        'slug'
    ];
}
