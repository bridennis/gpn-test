<?php

/**
 * Опции сервиса Числа.
 */

return [

    /**
     * Размер буфера для чтения файла.
     */
    'file' => [
        'read_buffer_length' => env('FILE_READ_BUFFER_LENGTH', 4096),
    ],

    /**
     * Максимальная длина логируемого запроса.
     */
    'log' => [
        'request_max_length' => env('LOG_REQUEST_MAX_LENGTH', 65536),
    ],

];
