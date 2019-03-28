<?php

namespace App\Services;

use App\Http\Requests\NumbersFindInFileRequest;
use Illuminate\Support\Facades\Validator;

/**
 * Сервис: Числа
 *
 * @package App\Services
 */
class NumbersService
{
    /**
     * Возвращает из указанного файла ($fileName) список всех чисел в которых встречается искомая цифра ($digit).
     * Список возвращается отсортированным по убыванию количества цифр в числе.
     *
     * @param string $fileName Имя файла
     * @param int $digit Искомая цифра [1..9]
     *
     * @return string Строковое представление массива
     */
    public static function getFromFileByDigit(string $fileName, int $digit) :string
    {
        $resArr = [];

        if (static::validateArgsGetFromFileByDigitArgs($fileName, $digit)) {

            $curNumber = '';        // Текущее число
            $hasDigit = false;      // Признак наличия искомой цифры в числе

            foreach (static::genStringsFromFile($fileName) as $buffer) {
                for ($i = 0, $max= mb_strlen($buffer); $i < $max; $i++) {
                    $mbChar = mb_substr($buffer, $i, 1);

                    if (preg_match('|\d+|', $mbChar)) {
                        $curNumber .= $mbChar;
                        if (!$hasDigit && $mbChar == $digit) {
                            $hasDigit = true;
                        }
                    } elseif (!empty($curNumber)) {
                        if ($hasDigit) {
                            $resArr[] = (string) $curNumber;
                        }
                        $curNumber = '';
                        $hasDigit = false;
                    }
                }
            }
            if (!empty($curNumber) && $hasDigit) {
                $resArr[] = (string) $curNumber;
            }

            // Сортируем числа по длине сохраняя их естественный порядок нахождения в файле
            usort($resArr, function (string $a, string $b) {
                return -(mb_strlen($a) <=> mb_strlen($b));
            });
        }

        return static::arrayToString($resArr);
    }

    /**
     * Валидация входных данных метода getFromFileByDigit.
     *
     * @param string $file
     * @param int $digit
     * @return bool
     */
    protected static function validateArgsGetFromFileByDigitArgs(string $file, int $digit) :bool
    {
        $validator = Validator::make(compact($file, $digit), (new NumbersFindInFileRequest())->rules());

        return $validator->fails();
    }

    /**
     * Чтение данных из файла.
     *
     * @param string $fileName
     * @return \Generator
     */
    protected static function genStringsFromFile(string $fileName)
    {
        $handle = fopen($fileName, 'r');
        $fileReadBufferLength = config('numbers.file.read_buffer_length');

        while(!feof($handle)) {
            yield fgets($handle, $fileReadBufferLength);
        }

        fclose($handle);
    }

    /**
     * Возвращает строковое представление массива.
     * @param array $arr
     * @return string
     */
    protected static function arrayToString(array $arr) :string
    {
        return "[\n" . implode(",\n", $arr) . "\n]\n";
    }
}
