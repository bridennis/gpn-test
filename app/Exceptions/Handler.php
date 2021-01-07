<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     */
    public function report(Throwable $e): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        parent::report($e);
    }

    /**
     * @inheritdoc
     */
    public function render($request, Throwable $e): Response
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return parent::render($request, $e);
    }
}
