<?php

namespace App\Services;

use App\Contracts\ExchangeRateRepositoryInterface;
use NumberFormatter;

/**
 * Сервис конвертер валют.
 *
 * @package App\Services
 */
class ExchangeService
{

    /**
     * @var ExchangeRateRepositoryInterface
     */
    private $exchangeRateProvider;

    public function __construct(ExchangeRateRepositoryInterface $exchangeRate)
    {
        $this->exchangeRateProvider = $exchangeRate;
    }

    /**
     * Конвертирует валюту в рубли по текущему курсу.
     *
     * @param int $amount Сумма в валюте для конвертации. Целое число
     * @param string $currency Коды валюты в стандарте ISO 4217
     *
     * @return string Сумма в рублях. -1 в случае невозможности конвертации
     */
    public function convertFromCurrencyToRub(int $amount, string $currency) :string
    {
        $value = $this->exchangeRateProvider->getValue($currency);
        $nominal = $this->exchangeRateProvider->getNominal($currency);

        return ($value && $nominal) ?
            NumberFormatter::create('ru_RU', NumberFormatter::DECIMAL)
                ->format(($value / $nominal) * $amount)
            : -1;
    }
}
