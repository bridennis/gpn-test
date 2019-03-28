<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель NumbersLog
 *
 * @property string $ip_address
 * @property string $request
 * @package App
 */
class NumbersLog extends Model
{

    public $timestamps = false;

    /**
     * Таблица модели.
     *
     * @var string
     */
    protected $table = 'numbers_log';

    /**
     * Разворачивает структуру in_addr в читаемый IP-адрес.
     *
     * @param $value
     * @return bool|string
     */
    public function getIpAddressAttribute($value)
    {
        return inet_ntop($value);
    }

    /**
     * Сохраняет IPv4 и IPv6 в структуре in_addr.
     *
     * @param $value
     */
    public function setIpAddressAttribute($value)
    {
        $this->attributes['ip_address'] = inet_pton($value);
    }
}
