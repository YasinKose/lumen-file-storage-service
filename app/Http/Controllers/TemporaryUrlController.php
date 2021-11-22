<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\CreatesTemporaryUrlRequest;
use App\Http\Requests\CreateTemporaryUrlRequest;
use App\Models\File;
use App\Models\TemporaryUrl;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TemporaryUrlController extends Controller
{

    /**
     * @param CreateTemporaryUrlRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function create(CreateTemporaryUrlRequest $request, $id): JsonResponse
    {
        $file = File::find($id);

        if (!$file) {
            return (new ResponseHelper())->error("Geçersiz dosya no!");
        }

        return (new ResponseHelper())->success("Resim getirildi!", [
            'url' => $file->createTemporaryUrl()
        ]);
    }

    /**
     * @param CreatesTemporaryUrlRequest $request
     * @return JsonResponse
     */
    public function creates(CreatesTemporaryUrlRequest $request): JsonResponse
    {
        $files = [];
        foreach ($request->input("datas") as $key => $data) {
            if (empty($data)) {
                continue;
            }

            $file = File::where("id", ($data))->first();

            if (!$file) {
                continue;
            }

            $files[] = $file->createTemporaryUrl();
        }

        if (empty($files)) {
            return (new ResponseHelper())->error("Eksik veya hatalı alan!", [
                'datas' => ['Eşleşen hiç veri olmadı!']
            ]);
        }

        return (new ResponseHelper())->success("Linkler hazırlandı!", $files);
    }

    /**
     * @param $slug
     * @return BinaryFileResponse
     */
    public function show($slug): BinaryFileResponse
    {
        $file = TemporaryUrl::where('slug', $slug)->latest()->first();

        if (!$file || $file->created_at->addMinute(env("TEMPORARY_EXP_TIME", 5)) < Carbon::now()) {
            abort(404, "Bu link kullanılamaz.");
        }

        return new BinaryFileResponse($file->file->filePath, 200);
    }

    /**
     * @param $slug
     * @return BinaryFileResponse
     */
    public function download($slug): BinaryFileResponse
    {
        $file = TemporaryUrl::where('slug', $slug)->latest()->first();

        if (!$file || $file->created_at->addMinute(env("TEMPORARY_EXP_TIME", 5)) < Carbon::now()) {
            abort(404, "Bu link kullanılamaz.");
        }

        return response()->download($file->file->filePath, $file->file->originalName);
    }
}
