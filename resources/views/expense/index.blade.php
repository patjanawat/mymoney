@extends('layout.app')
@section('content')
    <div class="col-md-6 offset-md-3">  
        @if(!Auth::guest())
        <a href="/expense/create" class="btn btn-primary">New</a>
        @endif
        <div class="justify-content-md-center">
            <ul class="list-group margin-top-15">
                @foreach ($expensives as $item)        
                {!! Form::open(['action'=>['ExpenseController@destroy',$item->id],'method'=>'DELETE']) !!}            
                <li class="list-group-item">
                    <h3>
                        <p>
                            <a href="/expense/{{$item->id}}/edit">{{$item->detail}} <small>({{ $item->amount }}</small>)</a>
                            @if(!Auth::guest())
                            {{-- {!! Form::submit('Delete', ['class'=>'btn btn-danger float-right']) !!}     --}}
                            <button type="summit" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
            </div>
        </div>
@endsection