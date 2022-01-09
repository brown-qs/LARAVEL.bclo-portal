@extends('layouts.app')
@section('content')
<div class="row mb-5">
    <div class="col-md-3">
        <div class="card light-blue lighten-1 white-text">
            <div class="card-body">
                <h1 class="display-4 mt-4 center">{{$count_total}}</h1>
                <h3 class="center">Total Profiles</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card light-green lighten-2 white-text">
            <div class="card-body">
                <h1 class="display-4 mt-4 center">{{$count_paid}}</h1>
                <h3 class="center">Dues Paid</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card blue-grey lighten-2 white-text">
            <div class="card-body">
                <h1 class="display-4 mt-4 center">{{$count_no_paid}}</h1>
                <h3 class="center">Non Dues Paid</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card deep-orange lighten-2 white-text">
            <div class="card-body">
                <h1 class="display-4 mt-4 center">{{$count_no_mailbox}}</h1>
                <h3 class="center">No mailbox</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <form class="input-field col s6" action="{{route('estate.search')}}" method="get">
        {{csrf_field()}}
        <i class="fa fa-search prefix"></i>
        <input id="search_icon_prefix" type="text" class="validate" name="word" value="{{$search ?? ''}}" autofocus>
        <label for="search_icon_prefix">Search Everything through Address, Phone number, or Name ...</label>
    </form>
</div>
<div class="row align-items-stretch">
    <div class="col-md-3 mb-2">
        <a href="{{route('estate.create')}}" class="hoverable card btn white waves-effect" style="min-height: 100px; height: 90%">
            <div class="card-body d-flex justify-content-center">
                <p class="my-auto h1">+</p>
            </div>
        </a>
    </div>
    @foreach ( $houses as $house )
    <div class="col-md-3 mb-2">
        <a href="{{route('frontend.singlehouse', ['id' =>$house->id])}}" class="hoverable card btn white waves-effect" style="height: 90%; text-transform: unset;">
            <div class="card-body p-0">
                <h3 class="mt-4 light-blue-text center">{{$house->primary_first_name . ' ' . $house->primary_last_name}}</h3>
                <h5 class="center"><b>{{$house->land_id}}</b></h5>
                <p class="text-muted center">{{$house->address}}</p>
            </div>
        </a>
    </div>
    @endforeach

</div>
{{$houses->links()}}

@endsection