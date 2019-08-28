@extends('layout.app')
@section('content')
    <div class="col-md-6 offset-md-3">  
        <a href="/expense" class="btn btn-default"><< Back</a>
        <h1>Income</h1>
        {!! Form::open(['action' => ['ExpenseController@update',$expense->id],'method'=>'PUT']) !!}
            <div class="from-group">
                {{Form::label('amount', 'amount')}}
                {{Form::text('amount', $expense->amount, ['class' => 'form-control', 'placeholder' => 'Value'])}}
            </div>
            <div class="from-group">
                {{Form::label('detail', 'detail')}}
                {{Form::text('detail',$expense->detail,['class'=>'form-control','placeholder'=>'Detail'])}}
            </div>
            <div class="margin-top-15 margin-top-15">             
                {{ Form::submit('Submit',['class'=>'btn btn-primary']) }}            
            </div>
        {!! Form::close() !!}
    </div>
@endsection