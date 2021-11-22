<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\Domain;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{
    /**
     * @param StoreFileRequest $request
     * @return JsonResponse
     */
    public function store(StoreFileRequest $request): JsonResponse
    {
        $apiKey = Domain::select('id')->where('api_key', $request->input('apiKey'))->first();

        $urls = [];
        foreach ($request->file('file') as $index => $file) {

            $file = File::create([
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'extension' => $file->getClientOriginalExtension(),
                'file_path' => $file->move('docs', $file->hashName()),
                'domain_id' => $apiKey->id,
                'slug'      => Str::random(10)
            ]);

            $urls[] = [
                'original_name' => $file->original_name,
                'slug'          => $file->slug
            ];
        }

        return $this->respondOk('Dosyalar başarıyla yüklendi', $urls);
    }

    /**
     * @param $slug
     * @return BinaryFileResponse
     */
    public function show($slug): BinaryFileResponse
    {
        $file = File::where('slug', $slug)->firstOrFail();

        return new BinaryFileResponse($file->file_path, 200);
    }
}
