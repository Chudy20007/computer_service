@extends('main') @section('content')
<div class="containerr">
    <!--  Error handle -->
    @if($errors->any())
    <div class="row collapse">
        <ul class="alert-box warning radius">
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class='col-md-12 text-center'>
            <span class="form-header"> Rejestracja użytkownika </span>
        </div>
            <div class='col-md-1'>
                </div>
        <div class="col-md-10 picture ">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label label">Imię i nazwisko</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus> @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label label">Adres e-mail</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required> @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label label">Numer telefonu</label>

                            <div class="col-md-12">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus> @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label label">Hasło</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required> @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label label">Powtórz hasło</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                                                
                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label label">Rola</label>

                            <div class="col-md-12">
                                <select id="role" type="text" class="form-control" name="role" required autofocus>
                                   <option value="customer">klient</option>
                                   <option value="admin">administrator</option> 
                                   <option value="supervisor">kierownik</option> 
                                   <option value="employee">pracownik</option> 
                                    </select>   @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('post-code') ? ' has-error' : '' }}">
                            <label for="post-code" class="col-md-4 control-label label">Kod pocztowy</label>

                            <div class="col-md-12">
                                <input id="post-code" type="text" class="form-control" name="post-code"  placeholder="XX-XXX"  value="{{ old('post-code') }}" required autofocus> @if ($errors->has('post-code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('post-code') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label label">Miasto</label>

                            <div class="col-md-12">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}"  placeholder="city"  required autofocus> @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label for="street" class="col-md-4 control-label label">Ulica</label>
    
                                <div class="col-md-12">
                                    <input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}"  placeholder="street"  required autofocus> @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        <div class="form-group{{ $errors->has('local-number') ? ' has-error' : '' }}">
                            <label for="local-number" class="col-md-4 control-label label">Numer lokalu</label>

                            <div class="col-md-12">
                                <input id="local-number" type="text" class="form-control" name="local-number" placeholder="number"  value="{{ old('local-number') }}" required autofocus> @if ($errors->has('local-number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('local-number') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file" class="col-md-4 control-label label">Avatar</label>

                            <div class="col-md-12">
                                {{ Form::file('file', array('multiple'=>false,'accept'=>'image/jpeg','class'=>'formOption form-control')) }}
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