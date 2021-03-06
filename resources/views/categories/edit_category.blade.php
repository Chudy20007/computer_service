@extends('main') @section('content')
<div class='row'>
        <div class='col-md-12 text-center'>
                <span class="form-header"> Edytuj kategorię dla przedmiotów </span>
            </div>
        <div class='col-md-2'>
        </div>
    <div class='col-md-8 picture'>
        <div class='card'>
            <div class='panel-body'>
                @include('pictures.error_form') {!! Form::open(['url'=>'edit_category','class'=>'form-horizontal']) !!} @include('categories.category_edit_form')
                <div class='form-group'>
                    <div class='col-md-12 text-center'>
                        {!! Form::submit('Edytuj kategorię',['class'=>'btn btn-primary']) !!} {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
        </div>
</div>

@stop