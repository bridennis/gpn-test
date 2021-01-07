<?php
declare(strict_types=1);

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
    private ExchangeRateRepositoryInterface $exchangeRateProvider;

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
     * @return string Сумма в рублях
     */
    public function convertFromCurrencyToRub(int $amount, string $currency): string
    {
        $value = $this->exchangeRateProvider->getValue($currency);
        $nominal = $this->exchangeRateProvider->getNominal($currency);

        return ($value && $nominal) ?
            (string) NumberFormatter::create('ru_RU', NumberFormatter::DECIMAL)
                ->format(($value / $nominal) * $amount)
            : '';
    }
}
