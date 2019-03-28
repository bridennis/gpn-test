<?php

namespace Tests\Unit;

use App\Services\ExchangeService;
use Tests\TestCase;

class ExchangeServiceTest extends TestCase
{
    /**
     * Конвертируем 100 USD в рубли.
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
}
