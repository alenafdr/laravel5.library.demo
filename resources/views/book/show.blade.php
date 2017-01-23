@extends('layouts.app')

@section('content')

    <ol class="breadcrumb">
      <li><a href="/">Главная</a></li>
      <li><a href="{{ route('book.index') }}">Книги</a></li>
      <li class="active">Книга #{{ $item->id }}</li>
    </ol>
    
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Просмотр книги</h3>
      </div>
      <div class="panel-body">
      

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Наименование:</strong>
                {{ $item->name }}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Автор:</strong>
                {{ $item->autor }}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Описание:</strong>
                {{ $item->description }}
            </div>
        </div>

    </div>
    
      </div>
    </div>
    
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Экземпляры книги</h3>
  </div>
  <div class="panel-body">
    <ul class="list-group">
      @foreach($item->units as $unit)
      <li class="list-group-item  {{ (count($unit->hands) === 1) ? 'list-group-item-warning' : '' }} {{ (count($unit->hands) > 1) ? 'list-group-item-danger' : '' }}">
        <b>Штрихкод: {{ $unit->barcode }}</b> 
        @if (count($unit->hands) === 1)
          > Выдан пользователю <a href="{{ route('user.show', $unit->hands->first()->user->id) }}">{{ $unit->hands->first()->user->name }}</a> с {{ $unit->hands->first()->take_at }}
        @elseif (count($unit->hands) > 1)
          > Более одной записи выдачи одного экземпляра книги!
        @else
          > В библиотеке
        @endif
      </li>
      @endforeach
    </ul>
  </div>
</div> 
@endsection
