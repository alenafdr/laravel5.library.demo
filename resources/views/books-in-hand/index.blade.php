@extends('app')

@section('content')

    <ol class="breadcrumb">
      <li><a href="/">Главная</a></li>
      <li class="active">Журнал выдачи</li>
    </ol>
    
    <div class="row">
      <div class="col-lg-12 margin-tb">
            <div class="pull-right" style="margin-bottom: 10px;">
                <a class="btn btn-success" href="{{ route('books-in-hand.create') }}"> Создать выдачу</a>
            </div>
      </div>
    </div>
    
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Журнал выдачи</h3>
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
            <th>Читатель</th>
            <th>Дата выдачи</th>
            <th>Дата возврата</th>
            <th style="width:320px">Действия</th>
        </tr>
    @foreach ($items as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->bookUnit->book->autor }} "{{ $item->bookUnit->book->name }}"</td>
        <td>{{ $item->bookUnit->barcode }}</td>
        <td>{{ $item->user->name }}</td>
        <td>{{ $item->take_at }}</td>
        <td>
          @if (is_null($item->return_at))
            {!! Form::open(['method' => 'PUT','route' => ['books-in-hand.return', $item->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Вернуть', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
          @else
            {{ $item->return_at }}
          @endif 
        
        </td>
        <td>
            <a class="btn btn-info" href="{{ route('books-in-hand.show', $item->id) }}">Просмотреть</a>
            <a class="btn btn-primary" href="{{ route('books-in-hand.edit', $item->id) }}">Изменить</a>
            {!! Form::open(['method' => 'DELETE','route' => ['books-in-hand.destroy', $item->id],'style'=>'display:inline']) !!}
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