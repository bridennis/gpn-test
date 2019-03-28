<?php

namespace Tests\Unit;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Тестируем пример вывода.
     *
     * @return void
     */
    public function testExpectedOutputIsTrue()
    {
        $fileContents = '43534 кот 45 23';
        $digit = '4';

        $expectedString = <<<'EOD'
[
43534,
45
]

EOD;

        $mockNumbersService = new MockNumbersService($fileContents);

        $this->expectOutputString($expectedString);

        echo $mockNumbersService::getFromFileByDigit('', $digit);
    }
}
