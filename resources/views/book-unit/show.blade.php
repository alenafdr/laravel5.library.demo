@extends('app')

@section('content')

    <ol class="breadcrumb">
      <li><a href="/">Главная</a></li>
      <li><a href="{{ route('book-unit.index') }}">Экземпляры книг</a></li>
      <li class="active">Экземпляр #{{ $item->id }}</li>
    </ol>
    
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Просмотр экземпляра книги</h3>
      </div>
      <div class="panel-body">
      

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Книга:</strong>
                {{ $item->book->autor }} "{{ $item->book->name }}"
            </div>
            <div class="form-group">
                <strong>Штрихкод:</strong>
                {{ $item->barcode }}
            </div>
          
          <div class="form-group">
            <strong>Статус:</strong>          
            @if (count($item->hands) === 1)
              Выдан пользователю <a href="{{ route('user.show', $item->hands->first()->user->id) }}">{{ $item->hands->first()->user->name }}</a> с {{ $item->hands->first()->take_at }}
            @elseif (count($item->hands) > 1)
              Более одной записи выдачи одного экземпляра книги!
            @else
              В библиотеке. 
            @endif
          </div>
          
          
        </div>

    </div>
    
      </div>
    </div>
    
  <div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title">История выдачи книг</h3>
    </div>
    <div class="panel-body">
      <ul class="list-group">
        @foreach($item->history as $unit)
        <li class="list-group-item">{{ $unit->take_at }} - {{ $unit->return_at }} > <a href="{{ route('user.show', $unit->user->id) }}">{{ $unit->user->name }}</a></li>
        @endforeach
      </ul>
    </div>
  </div>

@endsection
