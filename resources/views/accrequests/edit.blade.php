@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 m-auto">

        <div class="card">
            <div class="card-header text-center">
                <h4 class="card-title">Update your Request</h4>
            </div>

            <div class="card-body">
                <form action="{{route('accrequest.update', ['id'=>$comment->id])}}" method="post">
                    @csrf
                    <div class="input-field">
                        <input type="text" name="username" value="{{Auth::user()->username}}" disabled>
                    </div>
                    <div class="input-field">
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" placeholder="file">
                        @error('file')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <textarea name="note" class="form-control @error ('note') is-invalid @enderror" placeholder="Update Note here....">{{$comment->note}}</textarea>
                        @error('note')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="input-field">
                        <button class="btn light-blue darken-1 white-text">

                            Update Note
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection