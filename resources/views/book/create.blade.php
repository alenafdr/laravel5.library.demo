@extends('layouts.app')

@section('content')

    <ol class="breadcrumb">
      <li><a href="/">Главная</a></li>
      <li><a href="{{ route('book.index') }}">Книги</a></li>
      <li class="active">Новая книга</li>
    </ol>
    
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Создание книги</h3>
      </div>
      <div class="panel-body">
      

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Внимание!</strong> Есть ошибки ввода<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('route' => 'book.store','method'=>'POST')) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Наименование:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Наименование','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Автор:</strong>
                {!! Form::text('autor', null, array('placeholder' => 'Автор','class' => 'form-control')) !!}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Описание:</strong>
                {!! Form::textarea('description', null, array('placeholder' => 'Описание','class' => 'form-control','style'=>'height:100px')) !!}
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