<?php

namespace Tests\Unit;


use App\Services\NumbersService;

class MockNumbersService extends NumbersService
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
}
