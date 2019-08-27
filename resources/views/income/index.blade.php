@extends('layout.app')
@section('content')    
    <a href="/income/create" class="btn btn-primary">New</a>
    <ul class="list-group">
        @foreach ($incomes as $income)            
        {!! Form::open(['action'=>['IncomeController@destroy',$income->id],'method'=>'DELETE']) !!}            
        <li class="list-group-item">
                <h3>
                    Amount: <a href="/income/{{$income->id}}/edit">{{ $income->amount }}</a>
                        {{-- <a href="/income/destroy" class="float-right">Delete</a> --}}
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger float-right']) !!}
                   
                </h3>
                
                <small>date:{{ $income->created_at }}</small>
                <small class="float-right">by: anonymouse </small>
            </li>
            {!! Form::close() !!}
            @endforeach
        </ul>
@endsection