<?php
declare(strict_types=1);

namespace App\Repository\Exchange;

use App\Contracts\ExchangeRateRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class FcmExchangeRateRepository implements ExchangeRateRepositoryInterface
{
    /**
     * URL ресурса для парсинга курсов валют.
     */
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @inheritDoc
     */
    public function getValue(string $currency): float
    {
        return (float) str_replace(',', '.', $this->parseElementProperty($currency, 'Value'));
    }

    /**
     * @inheritDoc
     */
    public function getNominal(string $currency): int
    {
        return (int) $this->parseElementProperty($currency, 'Nominal');
    }

    /**
     * Получить свойство валюты.
     */
    protected function parseElementProperty(string $currency, string $property): string
    {
        if ($xmlObj = simplexml_load_string($this->load())) {
            $path = sprintf('//Valute[%s="%s"]/%s/text()',
                is_numeric($currency) ? 'NumCode' : 'CharCode',
                mb_strtoupper($currency),
                $property
            );

            return !empty($xmlObj->xpath($path)) ? (string) $xmlObj->xpath($path)[0] : '';
        } else {
            // TODO: Информируем админа о том, что не смогли разобрать информацию с ресурса
            return '';
        }
    }

    /**
     * Загрузить данные о курсе валют из ресурса.
     */
    protected function load(): string
    {
        $cacheKey = config('exchange.currency_market.cache.key');

        if (Cache::has($cacheKey)) {
            $xmlString = Cache::get($cacheKey);
        } else {
            if (($xmlString = file_get_contents($this->url))) {
                Cache::store('file')
                    ->put($cacheKey, $xmlString, config('exchange.currency_market.cache.expired'));
            } else {
                // TODO: Информируем админа о том, что не смогли получить информацию с ресурса
                return '';
            }
        }
        return $xmlString;
    }
}
