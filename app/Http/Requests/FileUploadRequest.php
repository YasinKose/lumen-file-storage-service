<?php

namespace App\Http\Requests;

class FileUploadRequest extends FormRequest
{
    /**
     * @return string
     */
    public function responseMessage(): string
    {
        return "Validation error!";
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
            'apiKey' => ['required', 'string', 'exists:domains,apiKey'],
            'file'   => ['required', 'array']
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'apiKey' => 'API Key',
            'file'   => 'Dosya'
        ];
    }

}
