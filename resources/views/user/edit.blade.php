@extends('app')

@section('content')

    <ol class="breadcrumb">
      <li><a href="/">Главная</a></li>
      <li><a href="{{ route('user.index') }}">Читатели</a></li>
      <li class="active">Читатель #{{ $item->id }}</li>
    </ol>
    
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Редактирование читателя</h3>
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

    {!! Form::model($item, ['method' => 'PATCH','route' => ['user.update', $item->id]]) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Имя:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Имя','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Эл. почта:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Эл. почта','class' => 'form-control')) !!}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Пароль:</strong>
                {!! Form::text('password', null, array('placeholder' => 'Пароль','class' => 'form-control')) !!}
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