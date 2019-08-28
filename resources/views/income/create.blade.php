@extends('layout.app')
@section('content')
    <div class="col-md-6 offset-md-3">  
        <a href="/income" class="btn btn-default"><< Back</a>
        <h1>Income</h1>
        {!! Form::open(['action' => 'IncomeController@store','method'=>'POST']) !!}
            <div class="from-group">
                {{Form::label('category', 'Category')}}
                {{Form::select('category', [ '0' => 'Please select', '1' => 'Salary','2'=>'Sell'], '0',['class'=>'form-control'])}}
            </div>
            <div class="from-group">
                {{Form::label('value', 'Value')}}
                {{Form::text('value', '', ['class' => 'form-control', 'placeholder' => 'Value'])}}
            </div>
            <div class="from-group margin-top-15">             
                {{ Form::submit('Submit',['class'=>'btn btn-primary']) }}
            </div>
        {!! Form::close() !!} 
    </div>
@endsection