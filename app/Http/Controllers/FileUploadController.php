<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\FileUploadRequest;
use App\Models\Domain;
use App\Models\File;
use Illuminate\Http\JsonResponse;

class FileUploadController extends Controller
{
    /**
     * @param FileUploadRequest $request
     * @return JsonResponse
     */
    public function uploadFile(FileUploadRequest $request): JsonResponse
    {
        $apiKey = Domain::select("id")->where("apiKey", $request->input("apiKey"))->first();

        $files = [];
        foreach ($request->file("file") as $index => $file) {
            $files[] = File::create([
                'originalName' => $file->getClientOriginalName(),
                'mimeType' => $file->getClientMimeType(),
                'extension' => $file->getClientOriginalExtension(),
                'filePath' => $file->move('docs', $file->hashName()),
                'domainId' => $apiKey->id,
                'status' => $request->status ?? 0
            ]);
        }

        return (new ResponseHelper())->success("Dosyalar başarıyla yüklendi", $files);
    }
}
