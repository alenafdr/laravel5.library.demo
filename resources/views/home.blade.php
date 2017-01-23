@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h3>Тестовое приложение "Библиотека"</h3>
                    
                    @if (Auth::guest())
                      <h4>Для входа используйте тестовых пользователей:</h4>
                      <p>ivanov@mail.ru<br>petrov@mail.ru<br>sidorov@mail.ru<br>Пароли: 123456</p>
                      <p>Или зарегистрируйте нового пользователя.</p>
                    @else
                      <a href="{{ url('/user', Auth::user()->id) }}">Показать статистику по пользователю {{Auth::user()->name}}</a><br>
                    @endif
                    
                    <h4>API</h4>
                    <p>
                    <ul>
                    <li>/api/v1/users - User</li>
                    <li>/api/v1/books - Book</li>
                    <li>/api/v1/book-units - BookUnit</li>
                    <li>/api/v1/books-in-hands - BooksInHand</li>
                    </ul>
                    </p>
                    <p>
                    Заголовок запроса должен содержать<br>
                    Accept: application/json
                    </p>
                    <p>
                    В запросе требуется передавать "api_token" пользователя.
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
