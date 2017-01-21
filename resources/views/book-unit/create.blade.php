@extends('app')

@section('content')

    <ol class="breadcrumb">
      <li><a href="/">Главная</a></li>
      <li><a href="{{ route('book-unit.index') }}">Экземпляры книг</a></li>
      <li class="active">Новый экземпляр книги</li>
    </ol>
    
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Создание экземпляра книги</h3>
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

    {!! Form::open(array('route' => 'book-unit.store','method'=>'POST')) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Книга:</strong>
                {!! Form::select('book_id', $books, null, ['class' => 'col-md-2 form-control', 'required', 'placeholder' => 'Книга']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Штрихкод:</strong>
                {!! Form::text('barcode', null, array('placeholder' => 'Штрихкод','class' => 'form-control')) !!}
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