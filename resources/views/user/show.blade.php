@extends('app')

@section('content')

    <ol class="breadcrumb">
      <li><a href="/">Главная</a></li>
      <li><a href="{{ route('user.index') }}">Читатели</a></li>
      <li class="active">Читатель #{{ $item->id }}</li>
    </ol>
    
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Просмотр читателя</h3>
      </div>
      <div class="panel-body">
      

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Имя:</strong>
                {{ $item->name }}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Эл. почта:</strong>
                {{ $item->email }}
            </div>
        </div>

    </div>
    
      </div>
    </div>
    
<div class="panel panel-warning">
  <div class="panel-heading">
    <h3 class="panel-title">Книги на руках</h3>
  </div>
  <div class="panel-body">
    <ul class="list-group">
      @foreach($item->bookInHand as $unit)
      <li class="list-group-item"><a href="{{ route('book.show', $unit->bookUnit->book->id) }}">{{ $unit->bookUnit->book->autor }} "{{ $unit->bookUnit->book->name }}"</a> (Выдана {{ $unit->take_at }})</li>
      @endforeach
    </ul>
  </div>
</div> 

<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">История выдачи книг</h3>
  </div>
  <div class="panel-body">
    <ul class="list-group">
      @foreach($item->bookHistory as $unit)
      <li class="list-group-item">{{ $unit->take_at }} - {{ $unit->return_at }} > <a href="{{ route('book.show', $unit->bookUnit->book->id) }}">{{ $unit->bookUnit->book->autor }} "{{ $unit->bookUnit->book->name }}"</a></li>
      @endforeach
    </ul>
  </div>
</div>

@endsection
