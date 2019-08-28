@extends('layout.app')
@section('content')    
    <div class="col-md-6 offset-md-3">
        <a href="/income/create" class="btn btn-primary">New</a>
        <ul class="list-group margin-top-15">
            @foreach ($incomes as $income)            
                {!! Form::open(['action'=>['IncomeController@destroy',$income->id],'method'=>'DELETE']) !!}            
                    <li class="list-group-item">
                        <h3>
                            @if(!Auth::guest())                            
                                <a href="/income/{{$income->id}}/edit"> @money($income->amount, 'THB',true) <small>({{$income->category_type}})</small></a>
                                <button type="summit" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            @else
                                @money($income->amount, 'THB',true) <small>({{$income->category_type}})</small>
                            @endif
                        </h3>
                            
                        <small>date:{{ $income->created_at }}</small>
                        <small class="float-right">Created By: {{ $income->created_by }} </small>
                    </li>
                {!! Form::close() !!}
            @endforeach
        </ul>
    </div>
@endsection