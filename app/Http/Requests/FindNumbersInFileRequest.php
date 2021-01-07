<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class FindNumbersInFileRequest extends FormRequest
{
    /**
     * Определяет пользователей авторизованных для этого запроса.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации.
     */
    public function rules(): array
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
