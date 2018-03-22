@extends('main') @section('content')
<div class='row'>
    <div class='col-md-12 picture'>
        <div class='card'>
            <div class='panel-body'>

                @include('pictures.error_form') {!! Form::open(['url'=>'edit_employee
                ','class'=>'form-horizontal']) !!}
                 {{ method_field('PATCH') }}
                 @include('employees.register_employee')


                <div class='form-group'>
                    <div class='col-md-6'>
                        {!! Form::submit('Edit employee',['class'=>'btn btn-primary']) !!} {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop