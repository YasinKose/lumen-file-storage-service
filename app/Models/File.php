<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class File extends Model
{
    protected $fillable = [
        'originalName',
        'mimeType',
        'extension',
        'filePath',
        'domainId'
    ];

    /**
     * @return mixed
     */
    public function createTemporaryUrl()
    {
        if (empty($this->id)) {
            return null;
        }

        $file = TemporaryUrl::where("file_id", $this->id)->latest()->first();

        if (!$file || (!($file->file->is_private) && $file->created_at->addMinute(env("TEMPORARY_EXP_TIME", 5)) < Carbon::now())){
            $file = TemporaryUrl::create([
                'slug' => Str::random(10),
                'file_id' => $this->id
            ]);
        }

        return [
            'fileId' => $file->file_id,
            'originalName' => $file->file->originalName,
            'slug' => $file->slug,
            'show' => route("show-file", ['slug' => $file->slug]),
            'download' => route("download-file", ['slug' => $file->slug]),
        ];
    }

    /**
     * @return HasMany
     */
    public function temporaryUrls(): HasMany
    {
        return $this->hasMany(TemporaryUrl::class);
    }
}
