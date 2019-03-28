<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class NumbersFindInFileRequest extends FormRequest
{
    /**
     * Определяет пользователей авторизованных для этого запроса.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Правила валидации.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => [
                'required',
                function ($attribute, $value, $fail) {
                    $fileName = $value instanceof UploadedFile ? $value->getRealPath() : $value;
                    if (!is_readable($fileName)) {
                        $fail(sprintf(
                            'Атрибут <%s>: файл <%s> не найден или недоступен для чтения.',
                            $attribute,
                            $fileName
                        ));
                    }
                },
             ],
            'digit' => 'required|integer|min:1|max:9',
        ];
    }
}
