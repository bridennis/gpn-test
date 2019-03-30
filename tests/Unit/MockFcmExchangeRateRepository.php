<?php

namespace Tests\Unit;


use App\Repository\Exchange\FcmExchangeRateRepository;

class MockFcmExchangeRateRepository extends FcmExchangeRateRepository
{

    protected function load(): string
    {
        return ExchangeServiceTest::$fcmCacheGet;
    }
}
