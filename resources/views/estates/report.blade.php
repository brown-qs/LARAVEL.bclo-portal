@extends('layouts.app')
@section('content')
<a href="{{route('dashboard')}}" class="btn btn-lg">Back to Search</a>
<div class="mb-5"></div>
<h2 class="center mb-3">{{$report_title}}</h2>
<table class="highlight">
    <thead>
        <tr>
            <th>Land ID</th>
            <th>Primary Owner</th>
            <th>Secondary Owner</th>
            <th>Mailbox?</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Mailing Address</th>
            <th>Acres</th>
            <th>Dues Paid?</th>
        </tr>
    </thead>

    <tbody>
        @foreach ( $profiles as $house )
        <tr>
            <td>{{$house->land_id}}</td>
            <td>
                <a href="{{route('frontend.singlehouse', ['id' =>$house->id])}}"> {{$house->primary_first_name.' '.$house->primary_last_name}} </a>
            </td>
            <td>{{$house->secondary_first_name.' '.$house->secondary_last_name}}</td>
            <td>
                @if($house->has_mailbox)
                <i class="fa fa-check light-green-text"></i>
                @else
                <i class="fa fa-minus red-text"></i>
                @endif
            </td>
            <td>{{$house->phone}}</td>
            <td>{{$house->email}}</td>
            <td>{{$house->address}}</td>
            <td>{{$house->mailing_address}}</td>
            <td>{{$house->acres}}</td>
            <td>
                @if($house->is_paid)
                <i class="fa fa-check light-green-text"></i>
                @else
                <i class="fa fa-minus red-text"></i>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection