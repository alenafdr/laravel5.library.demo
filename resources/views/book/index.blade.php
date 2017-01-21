@extends('app')

@section('content')

    <ol class="breadcrumb">
      <li><a href="/">Главная</a></li>
      <li class="active">Книги</li>
    </ol>
    
    <div class="row">
      <div class="col-lg-12 margin-tb">
            <div class="pull-right" style="margin-bottom: 10px;">
                <a class="btn btn-success" href="{{ route('book.create') }}"> Создать книгу</a>
            </div>
      </div>
    </div>
    
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Книги</h3>
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
            <th>Наименование</th>
            <th>Автор</th>
            <th>Описание</th>
            <th style="width:320px">Действия</th>
        </tr>
    @foreach ($items as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->autor }}</td>
        <td>{{ $item->description }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('book.show', $item->id) }}">Просмотреть</a>
            <a class="btn btn-primary" href="{{ route('book.edit', $item->id) }}">Изменить</a>
            {!! Form::open(['method' => 'DELETE','route' => ['book.destroy', $item->id],'style'=>'display:inline']) !!}
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