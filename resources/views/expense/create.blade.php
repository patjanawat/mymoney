@extends('layout.app')
@section('content')
    <div class="col-md-6 offset-md-3">  
        <a href="/expense" class="btn btn-default"><< Back</a>
        <h1>Expense</h1>
        {!! Form::open(['action' =>'ExpenseController@store','method'=>'POST']) !!}
            <div class="from-group">
                {{Form::label('amount', 'amount')}}
                {{Form::text('amount', '', ['class' => 'form-control', 'placeholder' => 'Value'])}}
            </div>
            <div class="from-group">
                {{Form::label('detail', 'detail')}}
                {{Form::text('detail','',['class'=>'form-control','placeholder'=>'Detail'])}}
            </div>
            <div class="from-group margin-top-15">             
                {{ Form::submit('Submit',['class'=>'btn btn-primary']) }}            
            </div>
        {!! Form::close() !!}
    </div>
    @endsection