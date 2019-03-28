<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeConvertToRequest extends FormRequest
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
