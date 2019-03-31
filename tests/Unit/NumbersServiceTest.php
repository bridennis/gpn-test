<?php

namespace Tests\Unit;

use App\Services\NumbersService;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public static $fileContents = '43534 кот 45 23';
    public static $digit = '4';
    public static $expectedString = <<<'EOD'
[
43534,
45
]

EOD;

    /**
     * Тестируем пример вывода.
     *
     * @return void
     */
    public function testExpectedOutputIsTrue()
    {
        $mockNumbersService = new MockNumbersService(static::$fileContents);

        $this->expectOutputString(static::$expectedString);

        echo $mockNumbersService::getFromFileByDigit('', static::$digit);
    }

    /**
     * Тестируем пример вывода.
     * Используем контейнер внедрения зависимостей и мокирование анонимным классом.
     *
     * @return void
     */
    public function testMockingThroughAnonymousClassNumbersServiceExpectedOutputIsTrue()
    {
        $fileContents = static::$fileContents;
        app()->bind('App\Services\NumbersService', function () use ($fileContents) {
            return new class($fileContents) extends NumbersService
            {
                private static $fileContents;

                public function __construct($fileContents)
                {
                    static::$fileContents = $fileContents;
                }

                protected static function validateArgsGetFromFileByDigitArgs(string $file, int $digit): bool
                {
                    return true;
                }

                protected static function genStringsFromFile(string $fileName)
                {
                    yield static::$fileContents;
                }
            };
        });

        $this->expectOutputString(static::$expectedString);

        echo app('App\Services\NumbersService')::getFromFileByDigit('', static::$digit);
    }
}
