@extends('layouts.app')

@section('content')

    <ol class="breadcrumb">
      <li><a href="/">Главная</a></li>
      <li><a href="{{ route('books-in-hand.index') }}">Журнал выдачи</a></li>
      <li class="active">Выдача #{{ $item->id }}</li>
    </ol>
    
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Редактирование выдачи</h3>
      </div>
      <div class="panel-body">
        
        
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Внимание!</strong> Некоторые поля неправильно заполнены.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($item, ['method' => 'PATCH','route' => ['books-in-hand.update', $item->id]]) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Экземпляр книги:</strong>
                {!! Form::select('book_unit_id', $units, null, ['class' => 'col-md-2 form-control', 'required', 'placeholder' => 'Экземпляр книги']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Читатель:</strong>
                {!! Form::select('user_id', $users, null, ['class' => 'col-md-2 form-control', 'required', 'placeholder' => 'Читатель']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Дата выдачи:</strong>
                {!! Form::text('take_at', null, array('placeholder' => 'Дата выдачи','class' => 'form-control')) !!}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Дата возврата:</strong>
                {!! Form::text('return_at', null, array('placeholder' => 'Дата возврата','class' => 'form-control')) !!}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>

    </div>
    {!! Form::close() !!}
    
      </div>
    </div>


    

@endsection