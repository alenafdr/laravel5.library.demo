# Демонстрационное приложение "Библиотека" на фреймворке Laravel5

## Задание

Необходимо реализовать на Laravel/Symfony приложение, которое представляет собой библиотеку, где есть пользователи (User) и книги (Book).

Список действий, которые должны быть доступны при помощи REST API:

- добавление новой книги в библиотеку

- отметка, о взятии книги пользователем (TEST)

- список книг, взятых пользователем

- статистика самых читающих пользователей (TEST)

Отмеченные знаком “(TEST)” действия необходимо покрыть при помощи тестов. Оформить в виде git репозитория, продемонстрировав историю разработки.

## Реализация

### Тезисы

Так как нет четкого технического задания, можем принять следующие принципы создаваемого приложения:

- В приложении должны быть пользователи (User) и книги (Book).

- Так как в классическом приложении под пользователями понимаются операторы работающие в приложении,
а в нашем случае под пользователями понимаются Читатели, то модель User будем воспринимать как "Читатели"

- Так как в библиотеке может быть несколько экземпляров одной книги, принято решение описание книги хранить в модели "Book".
И реализовать модель "BookUnit" для описания экземпляров книг. Вся дальнейшая работа по выдаче книг и их возврату идет с моделью "BookUnit"

- Журналирование выдачи книги можно производить в модели "BookUnit" через поля: (bool) "на руках", (User) "у читателя", (timestamp) "когда выдано".
Но так как в ТЗ указана возможность получения статистики самых читающих пользователей, то принято решение вести историю взятия книг на руки через модель "BooksInHand".

### Сущности БД

Book - книги
- name: Наименование книги
- autor: Автор книги
- description: Описание книги

BookUnit - Экземпляры книг
- book_id: Ссылка на книгу
- barcode: Штрих код

BooksInHand - Журнал выдачи экземпляров книг
- book_unit_id: Ссылка на Экземпляр книги
- user_id: Ссылка на Читателя
- take_at: Временная метка выдачи книги
- return_at: Временная метка возврата книги

User - Читатели
- name: ФИО
- email: Эл.адрес
- api_token: Для доступа через REST api
- password: Пароль

### Контроллеры

Для каждой модели реализованы CRUD контроллеры, обеспечивающие все базовые действия c моделью.
Для модели "BooksInHand" дополнительно реализован функционал установки отметки о возврате книги.

Route:
- /user - User
- /book - Book
- /book-unit - BookUnit
- /books-in-hand - BooksInHand

### API Контроллеры

Для каждой модели реализованы REST API контроллеры, обеспечивающие все базовые действия c моделью.

Route:
- /api/v1/users - User
- /api/v1/books - Book
- /api/v1/book-units - BookUnit
- /api/v1/books-in-hands - BooksInHand

Для API контроллера BooksInHand добавлены два экшена
- Api\v1\BooksInHandController@inHand '/api/v1/books-in-hands/in-hand/{id}' : список книг, взятых пользователем 
- Api\v1\BooksInHandController@statistics '/api/v1/books-in-hands/statistics' : статистика самых читающих пользователей

### Реализованы необходимые юнит тесты

- ApiV1BooksInHandControllerTest.php

# Быстрый старт

## Миграция и тестовые данные

Для миграции моделей выполнить:
php artisan migrate

Для загрузки тестовых данных выполнить:
php artisan db:seed

## Вход в систему

Для входа используйте тестовых пользователей:
- ivanov@mail.ru
- petrov@mail.ru
- sidorov@mail.ru
Пароли: 123456

Или зарегистрируйте нового пользователя.

# Screenshot

Журнал выдачи
![](https://github.com/dnech/laravel5.library.demo/blob/master/screenshot/Screenshot_1.png)

Читатели
![](https://github.com/dnech/laravel5.library.demo/blob/master/screenshot/Screenshot_2.png)

Просмотр читателя
![](https://github.com/dnech/laravel5.library.demo/blob/master/screenshot/Screenshot_3.png)

Книги
![](https://github.com/dnech/laravel5.library.demo/blob/master/screenshot/Screenshot_4.png)

Просмотр книги
![](https://github.com/dnech/laravel5.library.demo/blob/master/screenshot/Screenshot_5.png)

Экземпляры книг
![](https://github.com/dnech/laravel5.library.demo/blob/master/screenshot/Screenshot_6.png)

Просмотр экземпляра книги
![](https://github.com/dnech/laravel5.library.demo/blob/master/screenshot/Screenshot_7.png)

Пример REST API
![](https://github.com/dnech/laravel5.library.demo/blob/master/screenshot/Screenshot_8.png)

