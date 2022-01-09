@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 m-auto">
        <a href="{{route('frontend.singlehouse', ['id'=>$estate->id])}}" class="btn btn-lg">Back to Profile</a>
        <div class="card">
            <div class="card-header text-center">
                <h4 class="card-title">Add Payment</h4>
            </div>

            <div class="card-body">
                <form action="{{route('estate.payment.add', ['id'=>$estate->id])}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="input-field col m12">
                            <input id="date" type="text" name="date" class="form-control  @error('date') is-invalid @enderror" value="{{old('date')}}">
                            <label for="date">Date</label>
                            @error('date')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m12">
                            <input id="amount" type="number" step="any" name="amount" class="form-control  @error('amount') is-invalid @enderror" value="{{old('amount')}}">
                            <label for="amount">Amount Paid</label>
                            @error('amount')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <textarea name="note" class="form-control @error ('note') is-invalid @enderror" placeholder="Leave note here....">{{old('note')}}</textarea>

                        @error('note')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="input-field">
                        <p>
                            <label>
                                <input type="hidden" name="is_paid" value="0">
                                <input type="checkbox" name="is_paid" value="1" <?= old('is_paid') ? 'checked' : '' ?>>
                                <span>Paid ?</span>
                            </label>
                        </p>
                    </div>

                    <div class="input-field">
                        <button class="btn light-blue darken-1 white-text">

                            Add
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection