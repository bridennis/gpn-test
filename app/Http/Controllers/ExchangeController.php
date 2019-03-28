<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeConvertToRequest;

class ExchangeController extends Controller
{
    /**
     * Выводит результат конвертации валюты в рубли.
     *
     * @param ExchangeConvertToRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toRub(ExchangeConvertToRequest $request)
    {
        $validated = $request->validated();

        $result = app('App\Services\ExchangeService')
            ->convertFromCurrencyToRub($validated['amount'], $validated['currency']);

        return view('currency.convert-to', array_merge(['result' => $result], $validated));
    }
}
