<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeConvertToRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ExchangeController extends Controller
{
    /**
     * Выводит результат конвертации валюты в рубли.
     *
     * @return Factory|View
     */
    public function toRub(ExchangeConvertToRequest $request)
    {
        $validated = $request->validated();

        $result = app('App\Services\ExchangeService')
            ->convertFromCurrencyToRub((int) $validated[ 'amount' ], $validated[ 'currency' ]);

        return view('currency.convert-to', array_merge([ 'result' => $result ], $validated));
    }
}
