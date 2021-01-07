<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\Services\NumbersService;
use Tests\TestCase;

class NumbersServiceTest extends TestCase
{
    public static string $fileContents = '43534 кот 45 23';
    public static int $digit = 4;
    public static string $expectedString = <<<'EOD'
[
43534,
45
]

EOD;

    /**
     * Тестируем пример вывода.
     */
    public function testExpectedOutputIsTrue(): void
    {
        $mockNumbersService = new MockNumbersService(static::$fileContents);

        $this->expectOutputString(static::$expectedString);

        echo $mockNumbersService::getFromFileByDigit('', static::$digit);
    }

    /**
     * Тестируем пример вывода.
     * Используем контейнер внедрения зависимостей и мокирование анонимным классом.
     */
    public function testMockingThroughAnonymousClassNumbersServiceExpectedOutputIsTrue(): void
    {
        $fileContents = static::$fileContents;
        app()->bind('App\Services\NumbersService', function () use ($fileContents) {
            return new class($fileContents) extends NumbersService
            {
                private static string $fileContents;

                public function __construct($fileContents)
                {
                    static::$fileContents = $fileContents;
                }

                protected static function validateArgsGetFromFileByDigitArgs(string $file, int $digit): bool
                {
                    return true;
                }

                protected static function genStringsFromFile(string $fileName): iterable
                {
                    yield static::$fileContents;
                }
            };
        });

        $this->expectOutputString(static::$expectedString);

        echo app('App\Services\NumbersService')::getFromFileByDigit('', static::$digit);
    }
}
