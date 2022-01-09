@extends('layouts.app')
@section('content')
<div class="row">
    <a href="/dashboard" class="btn btn-lg btn-default">Back to Search</a>
    <div class="col-md-12">
        <h3 class="center">{{$house->primary_first_name . ' ' . $house->primary_last_name}}
            <a href="#modal3" class="modal-trigger">
                @if($house->balance > 0)
                <span class="red-text">($ {{number_format($house->balance, 2)}})</span>
                @elseif($house->balance == 0)
                <span class="light-green-text">($ 0.00)</span>
                @else
                <span class="light-green-text">(-$ {{number_format(-$house->balance, 2)}})</span>
                @endif
            </a>
        </h3>
    </div>
    <div class="col-md-5">
        <ul class="list-group list-group-flush mt-4">
            <li class="list-group-item text-secondary">
                Land ID :
                <span class="float-right">{{$house->land_id}}</span>
            </li>

            <li class="list-group-item text-secondary"><a href="#modal1" class="modal-trigger">
                    Owner Dues Paid? :
                    <span class="float-right">{{$house->is_paid ? 'Paid' : 'No'}}
                        <span class="red-text">({{count($payments)}})</span>

                    </span></a>
            </li>
            <li class="list-group-item text-secondary">
                Owner has Mail Box? :
                <span class="float-right">{{$house->has_mailbox ? 'Yes' : 'No'}}</span>
            </li>
            <li class="list-group-item text-secondary">
                Phone Number :
                <span class="float-right">{{$house->phone}}</span>
            </li>
            <li class="list-group-item text-secondary">
                Email :
                <span class="float-right">{{$house->email}}</span>
            </li>
            <li class="list-group-item text-secondary">
                Primary Owner :
                <span class="float-right">{{$house->primary_first_name.' '.$house->primary_last_name}}</span>
            </li>
            <li class="list-group-item text-secondary">
                Secondary Owner :
                <span class="float-right">{{$house->secondary_first_name.' '.$house->secondary_last_name}}</span>
            </li>
            <li class="list-group-item text-secondary">
                Address :
                <span class="float-right">{{$house->address}}</span>
            </li>
            <li class="list-group-item text-secondary">
                Mailing Address :
                <span class="float-right">{{$house->mailing_address}}</span>
            </li>
            <li class="list-group-item text-secondary">
                Acres :
                <span class="float-right">{{$house->acres}}</span>
            </li>
            <li class="list-group-item text-secondary">
                Yearly Dues :
                <span class="float-right">{{$house->yearly_dues}}</span>
            </li>
            <li class="list-group-item text-secondary">
                Number of Lots :
                <span class="float-right">{{$house->lots}}</span>
            </li>
        </ul>
        <div class="mt-5">
            <div class="fixed-action-btn" style="position: absolute; right: 0; bottom: auto;">
                <a class="btn-floating blue-grey btn-large"><i class="fa fa-wrench"></i>
                </a>
                <ul>
                    <li><a class="btn-floating blue" href="{{route('estate.edit', ['id'=>$house->id])}}"><i class="fa fa-pencil"></i></a></li>
                    <li><a class="btn-floating blue" href="{{route('estate.payment', ['id'=>$house->id])}}"><i class="fa fa-dollar"></i></a></li>
                    <li><a class="btn-floating blue modal-trigger" href="#modal2"><i class="fa fa-credit-card"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-6">
        <div class="row">
            <ul class="tabs tabs-fixed-width">
                <li class="tab"><a class="blue-text active" href="#test1">Acc Requests <span class="red-text h5"> ({{count($requests)}})</span> </a></li>
                <li class="tab"><a class="blue-text" href="#test2">Letters <span class="red-text h5"> ({{count($letters)}})</span> </a></li>
                <li class="tab"><a class="blue-text" href="#test3">Comments <span class="red-text h5"> ({{count($comments)}})</span> </a></li>
            </ul>
            <div id="test1" class="col s12">

                <div class="card-body">
                    <form action="{{route('accrequest.store', ['id'=>$house->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-field">
                            <input type="text" name="name" value="{{Auth::user()->username}}" disabled>
                        </div>

                        <input type="hidden" name="estate_id" value="{{$house->id}}">

                        <div class="file-field input-field">
                            <div class="btn">
                                <span>Browse</span>
                                <input type="file" name="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate @error('file') is-invalid @enderror" type="text">
                            </div>
                            @error('file')
                            <span class="invalid-feedback d-block">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="note" class="form-control @error ('note') is-invalid @enderror" placeholder="Leave Note here....">{{old('note')}}</textarea>

                            @error('note')
                            <div class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="input-field">
                            <button class="btn light-blue darken-1 white-text">

                                Send Request
                            </button>
                        </div>
                    </form>
                    @foreach($requests as $comment)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item mb-2">
                            <a target="_blank" href="{{asset('uploads/files/'.$comment->file)}}">{{$comment->file}}</a>
                            <p>{{$comment->note}}</p>
                            <h6 class="light-blue-text">{{$comment->user->username}}</h6>
                            <p>{{$comment->created_at->diffForHumans()}}</p>
                            @if($comment->user->id ==Auth::id())
                            <div class="commentdetails">
                                <a href="{{route('accrequest.edit', ['id'=>$comment->id])}}" class="btn btn-primary"><i class="fas fa fa-edit"></i></a>
                                &nbsp;
                                <a href="{{route('accrequest.delete', ['id'=>$comment->id])}}" class="btn btn-danger"><i class="fas fa fa-trash"></i></a>
                            </div>
                            @endif


                        </li>
                    </ul>
                    @endforeach
                </div>

            </div>
            <div id="test2" class="col s12">


                <div class="card-body">
                    <form action="{{route('letter.store', ['id'=>$house->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-field">
                            <input type="text" name="name" value="{{Auth::user()->username}}" disabled>
                        </div>

                        <input type="hidden" name="estate_id" value="{{$house->id}}">

                        <div class="input-field">
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" placeholder="file">
                            @error('file')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea name="note" class="form-control @error ('note') is-invalid @enderror" placeholder="Leave Note here....">{{old('note')}}</textarea>

                            @error('note')
                            <div class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="input-field">
                            <button class="btn light-blue darken-1 white-text">

                                Send Letter
                            </button>
                        </div>
                    </form>
                    @foreach($letters as $comment)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item mb-2">
                            <a target="_blank" href="{{asset('uploads/files/'.$comment->file)}}">{{$comment->file}}</a>
                            <p>{{$comment->note}}</p>
                            <h6 class="light-blue-text">{{$comment->user->username}}</h6>
                            <p>{{$comment->created_at->diffForHumans()}}</p>
                            @if($comment->user->id ==Auth::id())
                            <div class="commentdetails">
                                <a href="{{route('letter.edit', ['id'=>$comment->id])}}" class="btn btn-primary"><i class="fas fa fa-edit"></i></a>
                                &nbsp;
                                <a href="{{route('letter.delete', ['id'=>$comment->id])}}" class="btn btn-danger"><i class="fas fa fa-trash"></i></a>
                            </div>
                            @endif
                        </li>
                    </ul>
                    @endforeach
                </div>

            </div>
            <div id="test3" class="col s12">

                <div class="card-body">
                    <form action="{{route('comment.store', ['id'=>$house->id])}}" method="post">
                        @csrf
                        <div class="input-field">
                            <input type="text" name="username" value="{{Auth::user()->username}}" disabled>
                        </div>

                        <div class="form-group">
                            <textarea name="body" class="form-control @error ('body') is-invalid @enderror" placeholder="Leave Comment here...."></textarea>

                            @error('body')
                            <div class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror
                        </div>

                        <input type="hidden" name="estate_id" value="{{$house->id}}">

                        <div class="input-field">
                            <button class="btn light-blue darken-1 white-text">
                                Leave Comment
                            </button>
                        </div>
                    </form>

                    @foreach($comments as $comment)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item mb-2">
                            {{$comment->body}}
                            <h6 class="light-blue-text">{{$comment->user->username}}</h6>
                            <p>{{$comment->created_at->diffForHumans()}}</p>
                            @if($comment->user->id ==Auth::id())
                            <div class="commentdetails">
                                <a href="{{route('comment.edit', ['id'=>$comment->id])}}" class="btn btn-primary"><i class="fas fa fa-edit"></i></a>
                                &nbsp;
                                <a href="{{route('comment.delete', ['id'=>$comment->id])}}" class="btn btn-danger"><i class="fas fa fa-trash"></i></a>
                            </div>
                            @endif


                        </li>
                    </ul>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Payments</h4>

        @foreach($payments as $comment)
        <div class="card mb-2">
            <div class="card-header h4 d-flex justify-content-between">
                <p class="my-auto">
                    <b>{{$comment->date}}</b> | {{$comment->amount}}
                    @if($comment->is_paid == 0) <span class="not_paid"> | <span class="red-text"> <i class="fa fa-warning"></i> Not Paid</span></span>
                    @endif
                </p>
                <div class="row">
                    @if($comment->is_paid == 0)
                    <form action="{{route('estate.payment.mark_paid', ['id'=> $comment->id ])}}" method="post">
                        {{csrf_field()}}
                        <button class="btn light-green-text btn-flat"> <i class="fa fa-check align-middle"></i> Mark Paid</button>
                    </form>
                    @endif
                    <form action="{{route('estate.payment.remove', ['id'=> $comment->id ])}}" method="post">
                        {{csrf_field()}}
                        <button class="btn red-text btn-flat"> <i class="fa fa-minus align-middle"></i> Remove</button>
                    </form>
                </div>
            </div>
            <li class="list-group-item">
                {{$comment->note}}
            </li>
        </div>
        @endforeach
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn btn-primary">OK</a>
    </div>
</div>
<div id="modal3" class="modal">
    <div class="modal-content">
        <h4>Credits</h4>

        @foreach($credits as $comment)
        <div class="card mb-2">
            <div class="card-header h4 d-flex justify-content-between">
                <p class="my-auto">
                    <b class="amber-text">$ {{$comment->amount}}</b> | {{$comment->created_at->diffForHumans()}}
                </p>
                <form action="{{route('estate.credit.remove', ['id'=> $comment->id ])}}" method="post">
                    {{csrf_field()}}
                    <button class="btn red-text btn-flat"> <i class="fa fa-minus align-middle"></i> Remove</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn btn-primary">OK</a>
    </div>
</div>
<div id="modal2" class="modal">
    <div class="modal-header">
        <h4>How Much this credit for?</h4>

    </div>
    <div class="modal-content">
        <form class="input-field" action="{{route('estate.credit', ['id'=> $house->id ])}}" method="post">
            {{csrf_field()}}
            <i class="fa fa-dollar prefix"></i>
            <input id="dolla_icon_prefix" type="number" step="any" required name="amount">
            <button class="mt-5 btn btn-primary float-right">Give Credit</button>
        </form>
    </div>
</div>

@section('scripts')
@parent
<script type="application/javascript">
    $(document).ready(function() {
        $('.tabs').tabs();
        $('.modal').modal();
        $('.fixed-action-btn').floatingActionButton({
            direction: 'left'
        });
    });
</script>
@stop
@endsection