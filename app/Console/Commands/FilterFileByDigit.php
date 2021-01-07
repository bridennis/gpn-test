<?php

namespace App\Console\Commands;

use App\Http\Requests\NumbersFindInFileRequest;
use App\Services\NumbersService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class FilterFileByDigit extends Command
{
    /**
     * Имя и подпись консольной команды.
     *
     * @var string
     */
    protected $signature = 'filter:file-by-digit
        {file : Полный путь к файлу}
        {digit : Искомая цифра от 1 до 9}';

    /**
     * Описание консольной команды.
     *
     * @var string
     */
    protected $description = 'Возвращает из файла список всех чисел в которых встречается искомая цифра';

    /**
     * Исполнение консольной команды.
     *
     * @return mixed
     */
    public function handle()
    {
        $validator = Validator::make($this->arguments(), (new NumbersFindInFileRequest())->rules());

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        try {
            echo NumbersService::getFromFileByDigit($this->argument('file'), $this->argument('digit'));
        } catch (\Exception $e) {
            die('Ошибка: ' . $e->getMessage() . "\n");
        }
        return 0;
    }
}
