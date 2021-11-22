<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class File extends Model
{
    protected $fillable = [
        'original_name',
        'mime_type',
        'extension',
        'file_path',
        'domain_id',
        'slug'
    ];
}
