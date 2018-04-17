@extends('main') @section('content')
<div class="container">
    <div class="row">
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
            <div class="col-md-1">
            </div>
        <div class="col-md-10 picture">
            <div class="panel panel-default card">
                <div class="panel-heading"></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="update">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label label">Imię i nazwisko</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus> @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label label">Adres e-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required> @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label label">Hasło</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required> @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label label">Powtórz hasło</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        {{ Form::hidden('user_id',$user->id) }}
                        @if (Auth::user()->isAdmin()) 
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label label">Uprawnienia:</label>

                            <div class="col-md-6">
                                <select id="privileges" type="select" class="form-control" name="privileges" required>
                                    <option value='1'> Admin </option>
                                    <option value='0'> Użytkownik </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label label">Aktywny:</label>

                            <div class="col-md-6">
                                <select id="active" type="select" class="form-control" name="active" required>
                                    <option value='1'> tak </option>
                                    <option value='0'> nie </option>
                                </select>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="file" class="col-md-4 control-label label">Avatar</label>
                            <div class="col-md-12">
                                {{ Form::file('file', array('multiple'=>false,'accept'=>'image/jpeg','class'=>'formOption form-control')) }}
                            </div>
                        </div>
                        </br>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-info">
                                    Aktualizuj
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            </div>
    </div>
    
</div>
@endsection