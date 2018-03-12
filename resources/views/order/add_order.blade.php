@extends('main') @section('content')
<div class="containerr">
    <div class="row">
            <div class="col-md-12 text-center">
                    <span class="form-header">Request repair</span>
            </div>
            <div class='col-md-1'>
                </div>
        <div class="col-md-10 picture ">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ URL::asset('store_order') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label label">Name</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="name surname" autofocus> @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('post-code') ? ' has-error' : '' }}">
                            <label for="post-code" class="col-md-4 control-label label">Post code number</label>

                            <div class="col-md-12">
                                <input id="post-code" type="text" class="form-control" name="post-code"  placeholder="XX-XXX"  value="{{ old('post-code') }}" required autofocus> @if ($errors->has('post-code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('post-code') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label label">City</label>

                            <div class="col-md-12">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}"  placeholder="city"  required autofocus> @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label for="street" class="col-md-4 control-label label">City</label>
    
                                <div class="col-md-12">
                                    <input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}"  placeholder="street"  required autofocus> @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        <div class="form-group{{ $errors->has('local-number') ? ' has-error' : '' }}">
                            <label for="local-number" class="col-md-4 control-label label">Local number</label>

                            <div class="col-md-12">
                                <input id="local-number" type="text" class="form-control" name="local-number" placeholder="number"  value="{{ old('local-number') }}" required autofocus> @if ($errors->has('local-number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('local-number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label label">E-Mail Address</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  placeholder="eq. xxx@xx.xx"  required> @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label label">Phone number</label>

                            <div class="col-md-12">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}"  placeholder="min. 9 digits"  required autofocus> @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('add-device') ? ' has-error' : '' }}">
                            <label style='margin-left:.3rem' for="device" class="col-md-4 control-label label">Add devices:</label>
<div class='row'>
                            <div style='margin-left:1rem;' class="col-md-11">
                                <input id="add-device" type="text" class="form-control" name="add-device" value="{{ old('add-device') }}" autofocus>
                                    
                                @if ($errors->has('add-device'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('add-device') }}</strong>
                                </span>
                                @endif
                            </div>
                          
                                <input type="button" class='small-img2'>
                                
                        </div>
                    </div>
                        <div class="form-group{{ $errors->has('') ? ' has-error' : '' }}">
                            <label for="device" class="col-md-4 control-label label">Devices:</label>

                            <div class="col-md-12">
                                <select id="device" class="form-control" name="device[]" value="{{ old('') }}" required multiple autofocus>
                                    
                                    </select>@if ($errors->has(''))
                                <span class="help-block">
                                    <strong>{{ $errors->first('') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label label">Description of the problem</label>

                            <div class="col-md-12">
                                <textarea id="description" type="textarea" class="form-control" name="description"  placeholder="description of your problems"  value="{{ old('description') }}" required autofocus></textarea> @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class='col-md-1'>
            </div>
    </div>
</div>

@endsection