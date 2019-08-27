@extends('layout.app')
@section('content')
    @if(!Auth::guest())
    <a href="/expense/create" class="btn btn-primary">New</a>
    @endif

    <ul class="list-group">
        @foreach ($expensives as $item)        
            {!! Form::open(['action'=>['ExpenseController@destroy',$item->id],'method'=>'DELETE']) !!}            
                <li class="list-group-item">
                    <h3>
                        <p>
                            <a href="/expense/{{$item->id}}/edit">{{$item->detail}} <small>({{ $item->amount }}</small>)</a>
                            @if(!Auth::guest())
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger float-right']) !!}    
                            @endif               
                        </p>                    
                    </h3>                
                    <small>date:{{ $item->created_at }}</small>
                    <small class="float-right">Created By: {{ $item->created_by }} </small>
                </li>
            {!! Form::close() !!}
        @endforeach
        <div style="text-align: right;'">
            <h3 >Total: {{ $amount }}</h3>
        </div>
        
    </ul>
@endsection