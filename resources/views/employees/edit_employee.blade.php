@extends('main') @section('content')
<div class='row'>
    <div class='col-md-12 picture'>
        <div class='card'>
            <div class='panel-body'>

                @include('pictures.error_form') {!! Form::open(['url'=>'edit_employee
                ','class'=>'form-horizontal']) !!}
                 {{ method_field('PATCH') }}
                 @include('employees.register_employee')


                <div class='form-group text-center'>
                    <div class='col-md-12'>
                        {!! Form::submit('Edytuj pracownika',['class'=>'btn btn-primary']) !!} {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop