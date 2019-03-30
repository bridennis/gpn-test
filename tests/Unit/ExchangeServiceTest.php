<?php

namespace Tests\Unit;

use App\Repository\Exchange\FcmExchangeRateRepository;
use App\Services\ExchangeService;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ExchangeServiceTest extends TestCase
{

    /**
     * @var string ответ от сервиса FCM
     */
    public static $fcmCacheGet = <<<'EOD'
<?xml version="1.0" encoding="utf-8"?>
<ValCurs Date="28.03.2019" name="Foreign Currency Market">
    <Valute ID="R01235">
        <NumCode>840</NumCode>
        <CharCode>USD</CharCode>
        <Nominal>1</Nominal>
        <Name>Доллар США</Name>
        <Value>64,5925</Value>
    </Valute>
</ValCurs>
EOD;

    /**
     * Конвертируем 100 USD в рубли.
     * Используем внешний класс для мокирования.
     *
     * @return void
     */
    public function testConvertFromUSDToRub()
    {
        $amount = 100;
        $currency = 'USD';

        $expected = '6459.25';

        $mockFcmExchangeRateRepository = new MockFcmExchangeRateRepository('');
        $exchangeService = new ExchangeService($mockFcmExchangeRateRepository);

        $this->assertEquals($expected, $exchangeService->convertFromCurrencyToRub($amount, $currency));
    }

    /**
     * Конвертируем 100 USD в рубли.
     * Используем мокирование фасадов.
     *
     * @return void
     */
    public function testMockingCacheFacadeAndConvertFromUSDToRub()
    {

        $amount = 100;
        $currency = 'USD';
        $expected = '6459.25';

        Cache::shouldReceive('has')
            ->twice()
            ->with(config('exchange.currency_market.cache.key'))
            ->andReturn(true);

        Cache::shouldReceive('get')
            ->twice()
            ->with(config('exchange.currency_market.cache.key'))
            ->andReturn(static::$fcmCacheGet);

        $exchangeService = new ExchangeService(new FcmExchangeRateRepository(''));

        $this->assertEquals($expected, $exchangeService->convertFromCurrencyToRub($amount, $currency));

    }
}
