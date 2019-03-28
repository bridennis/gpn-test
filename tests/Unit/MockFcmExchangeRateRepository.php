<?php

namespace Tests\Unit;


use App\Repository\Exchange\FcmExchangeRateRepository;

class MockFcmExchangeRateRepository extends FcmExchangeRateRepository
{

    protected function load(): string
    {
        $response = <<<'EOD'
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
        return $response;
    }
}
