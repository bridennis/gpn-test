<?php

namespace App\Contracts;


interface ExchangeRateRepositoryInterface
{
    /**
     * Получить курс валюты.
     *
     * @param string $currency Код валюты в стандарте ISO 4217
     * @return float
     */
    public function getValue(string $currency) :float;

    /**
     * Получить номинал валюты.
     *
     * @param string $currency Код валюты в стандарте ISO 4217
     * @return int
     */
    public function getNominal(string $currency) :int;
}
