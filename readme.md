[![Build Status](https://travis-ci.org/bridennis/gpn-test.svg?branch=master)](https://travis-ci.org/bridennis/gpn-test) 
[![codecov](https://codecov.io/gh/bridennis/gpn-test/branch/master/graph/badge.svg)](https://codecov.io/gh/bridennis/gpn-test)

### Задание:

Необходимо реализовать на Laravel проект с функционалом:
<details>
    <summary>1. Необходимо реализовать метод, который на вход принимает текстовый файл и одна цифра (от 1 до 9).</summary>

Нужно найти в файле все числа в которых встречается заданная цифра и отсортировать по количеству цифр в числе, например:

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
</details>

<details>
    <summary>2. Необходимо написать метод интеграции с курсом валют, рекомендую для примера использовать https://www.cbr-xml-daily.ru/daily_utf8.xml.</summary>
    
На вход подаем два параметра amount и currency. Необходимо сконвертировать значение amount относительно валюты, заданной в currency, например:
```
?amount=100&currency=USD
```
</details>

---

### Результат:

Laravel ^8.0

##### Требования

###### Общие

[PHP](https://www.php.net/downloads.php) >= 7.4.0

[Composer](https://getcomposer.org/)

###### Для запуска проекта в контейнере

[docker](https://www.docker.com/)

##### Запуск проекта в контейнере

```shell
docker-compose up -d
docker-compose exec php composer install
```

Открываем браузер: [http://localhost/](http://localhost/)

##### Примечания

- Функционал п. 1 через CLI (см. помощь):

```shell
docker-compose exec php php artisan help filter:file-by-digit
```

##### Запуск тестов

```shell
docker-compose exec php vendor/bin/phpunit
```
