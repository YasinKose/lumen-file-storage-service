<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\Domain;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Respond;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{
    /**
     * @param StoreFileRequest $request
     * @return JsonResponse
     */
    public function store(StoreFileRequest $request): JsonResponse
    {
        $domain = Domain::where('api_key', $request->input('api_key'))->first();

        if ($domain === null) {
            return Respond::error("Geçersiz sunucu bilgisi!");
        }

        $files = collect();
        collect($request->file('files'))->each(function ($file) use ($files, $request, $domain) {
            /** @var UploadedFile $file */
            $files->add(
                File::create([
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getClientMimeType(),
                    'extension' => $file->getClientOriginalExtension(),
                    'file_path' => $file->storeAs(
                        $request->input("path", "docs"),
                        $file->hashName()
                    ),
                    'domain_id' => $domain->id
                ])
            );
        });

        return Respond::ok(
            'Dosyalar başarıyla yüklendi',
            $files->all()
        );
    }

    /**
     * @param $uuid
     * @return BinaryFileResponse
     */
    public function show($uuid): BinaryFileResponse
    {
        $file = File::where('uuid', $uuid)->firstOrFail();

        return new BinaryFileResponse($file->file_path, 200);
    }
}
