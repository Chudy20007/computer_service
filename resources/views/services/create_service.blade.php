@extends('main') @section('content')
<div class='row'>
        <div class='col-md-12 text-center'>
                <span class="form-header"> Create service </span>
            </div>
        <div class='col-md-2'>
        </div>
    <div class='col-md-8 picture'>
        <div class='card'>
            <div class='panel-body'>
                @include('pictures.error_form') {!! Form::open(['url'=>'create_service','class'=>'form-horizontal']) !!} @include('services.service_create_form')
                <div class='form-group'>
                    <div class='col-md-6'>
                        {!! Form::submit('Create service',['class'=>'btn btn-primary']) !!} {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
        </div>
</div>

@stop