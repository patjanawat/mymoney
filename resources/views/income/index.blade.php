@extends('layout.app')
@section('content')    
    <a href="/income/create" class="btn btn-primary">New</a>
    <ul class="list-group">
        @foreach ($incomes as $income)            
            {!! Form::open(['action'=>['IncomeController@destroy',$income->id],'method'=>'DELETE']) !!}            
                <li class="list-group-item">
                    <h3>
                        @if(!Auth::guest())                            
                            Amount: <a href="/income/{{$income->id}}/edit">{{ $income->amount }}</a>
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger float-right']) !!}
                        @else
                            Amount: {{ $income->amount }}
                        @endif
                    </h3>
                        
                    <small>date:{{ $income->created_at }}</small>
                    <small class="float-right">Created By: {{ $income->created_by }} </small>
                </li>
            {!! Form::close() !!}
        @endforeach
        </ul>
@endsection