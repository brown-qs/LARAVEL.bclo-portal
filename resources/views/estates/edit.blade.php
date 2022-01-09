@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 m-auto">
        <a href="{{route('frontend.singlehouse', ['id'=>$estate->id])}}" class="btn btn-lg btn-default">Back to Profile</a>
        <div class="card">
            <div class="card-header center">
                <h3>Edit property details</h3>
            </div>
            <div class="card-body">
                <form action="{{route('estate.update', ['id' =>$estate->id])}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="input-field col m12">
                            <input id="land_id" type="text" name="land_id" class="form-control  @error('land_id') is-invalid @enderror" value="{{old('land_id', $estate->land_id)}}">
                            <label for="land_id">Property Land ID</label>
                            @error('land_id')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m12">
                            <p>
                                <label>
                                    <input type="hidden" name="is_paid" value="0">
                                    <input type="checkbox" name="is_paid" value="1" <?= old('is_paid', $estate->is_paid) ? 'checked' : '' ?>>
                                    <span>Is property owner dues paid ?</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m12">
                            <p>
                                <label>
                                    <input type="hidden" name="has_mailbox" value="0">
                                    <input type="checkbox" name="has_mailbox" value="1" <?= old('has_mailbox', $estate->has_mailbox) ? 'checked' : '' ?>>
                                    <span>Does property owner have mailbox ?</span>
                                </label>
                            </p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col m6">
                            <input id="phone" type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone', $estate->phone)}}">
                            <label for="phone">Owner's Phone Number</label>
                            @error('phone')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-field col m6">
                            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email', $estate->email)}}">
                            <label for="email">Owner's Email</label>
                            @error('email')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col m6">
                            <input id="secondary_first_name" type="text" name="primary_first_name" class="form-control @error('primary_first_name') is-invalid @enderror" value="{{old('primary_first_name', $estate->primary_first_name)}}">
                            <label for="primary_first_name"><b>Primary Owner</b> First Name</label>
                            @error('primary_first_name')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-field col m6">

                            <input id="primary_last_name" type="text" name="primary_last_name" class="form-control @error('primary_last_name') is-invalid @enderror" value="{{old('primary_last_name', $estate->primary_last_name)}}">
                            <label for="primary_last_name"><b>Primary Owner</b> Last Name</label>

                            @error('primary_last_name')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6">
                            <input id="secondary_first_name" type="text" name="secondary_first_name" class="form-control @error('secondary_first_name') is-invalid @enderror" value="{{old('secondary_first_name', $estate->secondary_first_name)}}">
                            <label for="secondary_first_name"><b>Secondary Owner</b> First Name</label>
                            @error('secondary_first_name')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-field col m6">

                            <input id="secondary_last_name" type="text" name="secondary_last_name" class="form-control @error('secondary_last_name') is-invalid @enderror" value="{{old('secondary_last_name', $estate->secondary_last_name)}}">
                            <label for="secondary_last_name"><b>Secondary Owner</b> Last Name</label>

                            @error('secondary_last_name')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="form-group">
                <label for="address_address">Address</label>
                <input type="text" id="address-input" name="address_address" class="form-control map-input">
                <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
            </div>
            <div id="address-map-container" style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div> -->

                        <div class="input-field col m12 text-prefix">
                            <input id="address" type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address', $estate->address)}}">
                            <label for="address">Address</label>
                            @error('address')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col m6 text-prefix">
                            <input id="mailing_address" type="text" name="mailing_address" class="form-control @error('mailing_address') is-invalid @enderror" value="{{old('mailing_address', $estate->mailing_address)}}">
                            <label for="mailing_address">Mailing Address</label>
                            @error('mailing_address')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-field col m6 text-prefix">
                            <input id="acres" type="number" step="any" name="acres" class="form-control @error('acres') is-invalid @enderror" value="{{old('acres', $estate->acres)}}">
                            <label for="acres">Acres</label>
                            @error('acres')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 text-prefix">
                            <input id="yearly_dues" type="number" step="any" name="yearly_dues" class="form-control @error('yearly_dues') is-invalid @enderror" value="{{old('yearly_dues', $estate->yearly_dues)}}">
                            <label for="yearly_dues">Yearly Dues</label>
                            @error('yearly_dues')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-field col m6 text-prefix">
                            <input id="lots" type="number" step="any" name="lots" class="form-control @error('lots') is-invalid @enderror" value="{{old('lots', $estate->lots)}}">
                            <label for="lots">Number of Lots</label>
                            @error('lots')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-field">
                        <button class="btn light-blue darken-1 white-text">Update Details</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script type="application/javascript">
    $(document).ready(function() {
        let address_base = "{{env('PROPERTY_BASE_ADDRESS')}}";
        $('#address').keyup(function(e) {
            console.log(this.value)
            let index = this.value.indexOf(address_base);
            if (index == -1 || index + address_base.length != this.value.length) {
                let caret = this.selectionStart;
                this.value = this.value.substr(0, caret - 1) + address_base;
                this.selectionStart = this.selectionEnd = caret - 1;
            }
        })
    })
</script>
@stop

@endsection