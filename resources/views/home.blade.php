@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Select Stock Indexes</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('stock_store')}}" method="post">
                        {{csrf_field()}}
                        <!-- Default unchecked -->
                        @foreach($stock_indexs as $stock_index)
                            @if(count($stock_index->user) > 0)
                            @foreach ($stock_index->user as $key => $stock_index_id)

                            <div class="custom-control custom-checkbox">
                            
                                <input type="checkbox" class="" name="stock_index[]" id="nifty_50" value="{{$stock_index->id}}" {{$stock_index_id?'checked':''}}>
                                <label class="" for="defaultUnchecked">{{$stock_index->index}}</label>
                            </div>
                            @endforeach
                            @else
                            <div class="custom-control custom-checkbox">
                            
                                <input type="checkbox" class="" name="stock_index[]" id="nifty_50" value="{{$stock_index->id}}">
                                <label class="" for="defaultUnchecked">{{$stock_index->index}}</label>
                            </div>
                            @endif
                        @endforeach    
                       <div class="custom-control">
                            <button type="submit" class="btn btn-primary">Submit Index</button>                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
