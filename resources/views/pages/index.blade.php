@extends('layout.app')
@section('content')
  @if(Auth::guest())
    <div class="jumbotron text-center">
        <h1>Welcome To My Money Application!</h1>
        <p>This is the laravel application create by Panawat Atjanawat.</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
    </div>
  @else
    @if(is_array($incomes->transactions) && count($incomes->transactions) > 0)
      <div class="col-md-6 offset-md-3">
          <div class="row">
              <div class="col-md-12 font-weight-700">Summary:</div>
          </div>

          <ul class="list-group list-group-flush">
            <li class="list-group-item">Income: <span class="float-right"> @money($incomes->total, 'THB',true)</span></li>
              <li class="list-group-item moeny-outcome">Outcome: <span class="float-right">- @money($outcomes['total'], 'THB',true)</span></li>
              <li class="list-group-item money-net"><span class="float-right">
                  @money($incomes->total - $outcomes['total'], 'THB',true)
              </span></li>
          </ul>
          
          @if(is_array($outcomes["transactions"]) && count($outcomes["transactions"]) > 0)
            <div class="row">
                <div class="col-md-12 margin-top-15 font-weight-700">Details:</div>
              <div class="col-md-12">
                <div id="accordion">
                  @foreach ($outcomes['transactions'] as $index=>$item)
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h6 class="mb-0">
                          <div data-toggle="collapse" data-target="#collapse{{$index}}" aria-expanded="{{$index==0?'true':'false'}}" aria-controls="collapse{{$index}}">                      
                            <span>{{$item['created_at']}}</span>
                            <span class="float-right">
                              @money($item['total'], 'THB',true)
                            </span>
                          <div>
                        </h6>
                      </div>
                  
                      <div id="collapse{{$index}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                          <ul class="list-group list-group-flush">
                            @foreach ($item["details"] as $detail)
                              <li class="list-group-item">
                                  {{$detail["detail"]}}
                                  <p class="float-right">
                                      @money($detail["amount"], 'THB',true)
                                  </p>
                              </li>  
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div> 
                  @endforeach                              
                  </div>
              </div>
            </div>
          @else
            <p>
              <h4>No expensive found.</h4>
            </p>
          @endif
      </div>
    @else
    <div class="jumbotron text-center">       
        <h1>No data found.</h1>
    </div>
    @endif
  @endif
@endsection