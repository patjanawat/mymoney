@extends('layout.app')
@section('content')
    <a href="/income" class="btn btn-default"><< Back</a>
    <h1>Income</h1>
    {!! Form::open(['action' => ['IncomeController@update',$income->id],'method'=>'PUT']) !!}
        <div class="from-group">
            {{Form::label('category', 'Category')}}
            {{Form::select('category', [ '0' => 'Please select', '1' => 'Salary','2'=>'Sell'], $income->category,['class'=>'form-control'])}}
        </div>
        <div class="from-group">
            {{Form::label('value', 'Value')}}
            {{Form::text('value', $income->amount, ['class' => 'form-control', 'placeholder' => 'Value'])}}
        </div>
        <div class="from-group">             
            {{ Form::submit('Submit',['class'=>'btn btn-primary']) }}            
        </div>
    {!! Form::close() !!}
@endsection