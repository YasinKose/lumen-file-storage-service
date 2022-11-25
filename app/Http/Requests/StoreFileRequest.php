<?php

namespace App\Http\Requests;

class StoreFileRequest extends FormRequest
{
    /**
     * @return string
     */
    public function responseMessage(): string
    {
        return "Dosya yüklenemedi!";
    }

    /**
     * Auth::check to check login status
     * Add true if login status is not important
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'api_key' => [
                'required',
                'string'
            ],
            'path' => [
                'nullable',
                'string'
            ],
            'files' => [
                'required',
                'array'
            ],
            'files.*' => [
                'required',
                'file'
            ]
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'apiKey' => 'Api anahtarı',
            'path' => "Dosya konumu",
            'files' => 'Dosyalar',
            'files.*' => 'Dosya'
        ];
    }

}
