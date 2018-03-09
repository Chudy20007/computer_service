@extends('main') @section('content')
<div class='row'>
        <div class='col-md-2'>
        </div>
    <div class='col-md-8  picture'>
        <div class='card'>
            <div class='panel-body'>

                @include('pictures.error_form') {!! Form::model($picture,['method'=>'PATCH','files' => true,'class'=>'form-horizontal','action'=>['PicturesController@update',$picture->id]])
                !!} @include('pictures.picture_form')


                <div class='form-group'>
                    <div class='col-md-6'>
                        {!! Form::submit('Edit pictures',['class'=>'btn btn-info']) !!} {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
        </div>
</div>
@stop