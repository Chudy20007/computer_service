@extends('main') @section('content')
<div class='row'>
        <div class='col-md-12 text-center'>
                <span class="form-header"> Utwórz kategorię dla przedmiotów </span>
            </div>
        <div class='col-md-2'>
        </div>
    <div class='col-md-8 picture'>
        <div class='card'>
            <div class='panel-body'>
                @include('pictures.error_form') {!! Form::open(['url'=>'create_category','class'=>'form-horizontal']) !!} @include('categories.category_create_form')
                <div class='form-group'>
                    <div class='col-md-12 text-center'>
                        {!! Form::submit('Utwórz kategorię',['class'=>'btn btn-primary']) !!} {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
        </div>
</div>

@stop