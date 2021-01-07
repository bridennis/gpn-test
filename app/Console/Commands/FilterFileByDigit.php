<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Http\Requests\FindNumbersInFileRequest;
use App\Services\NumbersService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class FilterFileByDigit extends Command
{
    /**
     * @inheritDoc
     */
    protected $signature = 'filter:file-by-digit
        {file : Полный путь к файлу}
        {digit : Искомая цифра от 1 до 9}';

    /**
     * @inheritDoc
     */
    protected $description = 'Возвращает из файла список всех чисел в которых встречается искомая цифра';

    public function handle(): int
    {
        $validator = Validator::make($this->arguments(), (new FindNumbersInFileRequest())->rules());

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return 1;
        }

        try {
            echo NumbersService::getFromFileByDigit($this->argument('file'), (int) $this->argument('digit'));
        } catch (Exception $e) {
            die('Ошибка: ' . $e->getMessage() . "\n");
        }

        return 0;
    }
}
