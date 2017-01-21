@extends('app')

@section('content')

    <ol class="breadcrumb">
      <li><a href="/">Главная</a></li>
      <li class="active">Экземпляры книг</li>
    </ol>
    
    <div class="row">
      <div class="col-lg-12 margin-tb">
            <div class="pull-right" style="margin-bottom: 10px;">
                <a class="btn btn-success" href="{{ route('book-unit.create') }}"> Создать экземпляр книги</a>
            </div>
      </div>
    </div>
    
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Экземпляры книг</h3>
      </div>
      <div class="panel-body">
      


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Книга</th>
            <th>Штрихкод</th>
            <th>Состояние</th>
            <th style="width:320px">Действия</th>
        </tr>
    @foreach ($items as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->book->autor }} "{{ $item->book->name }}"</td>
        <td>{{ $item->barcode }}</td>
        
        <td>
        @if (count($item->hands) === 1)
          Выдан пользователю <a href="{{ route('user.show', $item->hands->first()->user->id) }}">{{ $item->hands->first()->user->name }}</a> с {{ $item->hands->first()->take_at }}
        @elseif (count($item->hands) > 1)
          Более одной записи выдачи одного экземпляра книги!
        @else
          В библиотеке. 
        @endif
        </td>
        
        <td>
            <a class="btn btn-info" href="{{ route('book-unit.show', $item->id) }}">Просмотреть</a>
            <a class="btn btn-primary" href="{{ route('book-unit.edit', $item->id) }}">Изменить</a>
            {!! Form::open(['method' => 'DELETE','route' => ['book-unit.destroy', $item->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $items->render() !!}
     
     </div>
    </div>
    
@endsection