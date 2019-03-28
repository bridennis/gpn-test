<?php

namespace App\Http\Controllers;

use App\Http\Requests\NumbersFindInFileRequest;
use App\Services\NumbersService;
use Illuminate\Http\UploadedFile;

class NumbersController extends Controller
{
    /**
     * Выводит форму запроса для поиска чисел в файле.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('numbers.find-numbers');
    }

    /**
     * Выводит результат запроса с формы по поиску чисел в файле.
     *
     * @param NumbersFindInFileRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function findFromFileByDigit(NumbersFindInFileRequest $request)
    {
        $validated = $request->validated();

        /** @var UploadedFile $file */
        $file = $validated['file'];

        return view('numbers.find-numbers', [
            'result' => NumbersService::getFromFileByDigit($file->getRealPath(), $validated['digit'])
        ]);
    }

}
