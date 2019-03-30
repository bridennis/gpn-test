[![Build Status](https://travis-ci.org/bridennis/gpn-test.svg?branch=master)](https://travis-ci.org/bridennis/gpn-test) 
[![codecov](https://codecov.io/gh/bridennis/gpn-test/branch/master/graph/badge.svg)](https://codecov.io/gh/bridennis/gpn-test)



### Задание:

Необходимо реализовать на Laravel проект с функционалом:

1. Необходимо реализовать метод, который на вход принимает текстовый файл и одна цифра (от 1 до 9). Нужно найти в файле все числа в которых встречается заданная цифра и отсортировать по количеству цифр в числе, например:

43534 кот 45 23 - Содержимое файла

4 - второй параметр

На выходе ожидается:
```
[

43534,

45

]
```

Так же должна быть возможность выполнить такую же операцию из консольной команды.
Все запросы должны складываться в БД (любую).
 

2. Необходимо написать метод интеграции с курсом валют, рекомендую для примера использовать https://www.cbr-xml-daily.ru/daily_utf8.xml.

На вход подаем два параметра amount и currency. Необходимо сконвертировать значение amount относительно валюты , заданной в currency, например:

```
?amount=100&currency=USD
```

---

### Результат:

##### Требования

[PHP](https://www.php.net/downloads.php) >= 7.1.8

[Composer](https://getcomposer.org/)

Laravel framework 5.8.x
- см. [Server Requirements](https://laravel.com/docs/5.8/installation)

##### Запуск
```
composer install

cp .env.example .env
php artisan key:generate

touch database/database.sqlite
php artisan migrate --force

php artisan serve
```

Открываем браузер: [http://127.0.0.1:8000/](http://127.0.0.1:8000/)


##### Примечания

- Функционал 1 через CLI (см. помощь):

```
php artisan help numbers:get-from-file-by-digit
```

- Руководствуясь принципом YAGNI с одной стороны и текстом задания с другой, разработчик осознает вероятную избыточность фронтенд функционала и недостаточное (либо излишнее) покрытие тестами.
