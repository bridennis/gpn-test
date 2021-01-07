<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeConvertToRequest extends FormRequest
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
            'amount' => 'required|integer|min:1',
            'currency' => [
                'required',
                'size:3',
                function ($attribute, $value, $fail) {
                    //ISO 4217
                    if (!preg_match('/^([a-z]{3}|[\d]{3})/i', $value, $m)) {
                        $fail(sprintf('Атрибут <%s>: неверный формат.', $attribute));
                    }
                },
            ]
        ];
    }
}
