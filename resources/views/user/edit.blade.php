@extends('main') @section('content')
<div class='row'>
    <div class='col-md-8 col-md-offset-2 picture'>
        <div class='card'>
            <div class='panel-body'>

                @include('pictures.error_form') {!! Form::model(['method'=>'PATCH','class'=>'form-horizontal','action'=>['UserController@update']])
                !!} @include('user.register')


                <div class='form-group'>
                    <div class='col-md-6'>
                        {!! Form::submit('Edytuj użytkownika',['class'=>'btn btn-info']) !!} {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop