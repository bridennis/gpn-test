<?php

namespace App\Http\Controllers;

use App\Http\Requests\FindNumbersInFileRequest;
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
     * @param FindNumbersInFileRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function findFromFileByDigit(FindNumbersInFileRequest $request)
    {
        $validated = $request->validated();

        /** @var UploadedFile $file */
        $file = $validated['file'];

        return view('numbers.find-numbers', [
            'result' => NumbersService::getFromFileByDigit($file->getRealPath(), $validated['digit'])
        ]);
    }

}
