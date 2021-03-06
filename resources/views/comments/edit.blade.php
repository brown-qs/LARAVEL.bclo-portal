@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 m-auto">

        <div class="card">
            <div class="card-header text-center">
                <h4 class="card-title">Update your comment</h4>
            </div>

            <div class="card-body">
                <form action="{{route('comment.update', ['id'=>$comment->id])}}" method="post">
                    @csrf
                    <div class="input-field">
                        <input type="text" name="username" value="{{Auth::user()->username}}" disabled>
                    </div>

                    <div class="form-group">
                        <textarea name="body" class="form-control @error ('body') is-invalid @enderror" placeholder="Update Comment here....">{{$comment->body}}</textarea>

                        @error('body')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>



                    <div class="input-field">
                        <button class="btn light-blue darken-1 white-text">

                            Update Comment
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection