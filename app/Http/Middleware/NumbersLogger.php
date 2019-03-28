<?php

namespace App\Http\Middleware;

use Closure;

class NumbersLogger
{
    /**
     * Обрабатываем входящие запросы.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Логируем запросы в БД
        $numbersLog = new \App\NumbersLog();
        $numbersLog->ip_address = $request->ip();
        $numbersLog->request = mb_substr($request, 0, config('numbers.log.request_max_length'));
        $numbersLog->save();

        return $next($request);
    }
}
