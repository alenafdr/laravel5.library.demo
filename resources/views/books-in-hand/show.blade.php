@extends('app')

@section('content')

    <ol class="breadcrumb">
      <li><a href="/">Главная</a></li>
      <li><a href="{{ route('books-in-hand.index') }}">Журнал выдачи</a></li>
      <li class="active">Выдача #{{ $item->id }}</li>
    </ol>
    
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Просмотр выдачи</h3>
      </div>
      <div class="panel-body">
      

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Экземпляр книги:</strong>
                {{ $item->bookUnit->barcode . ' > ' . $item->bookUnit->book->autor . ' "' . $item->bookUnit->book->name . '"' }}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Читатель:</strong>
                {{ $item->user->name }}
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Дата выдачи:</strong>
                {{ $item->take_at }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Дата возврата:</strong>
                {{ $item->return_at }}
            </div>
        </div>
        
    </div>
    
      </div>
    </div>
    
@endsection
