@extends('main') @section('content')
<div class='row'>
        <div class='col-md-12 text-center'>
                <span class="form-header">Edytuj zlecenie </span>
            </div>
        <div class='col-md-2'>
        </div>
    <div class='col-md-8 picture'>
        <div class='card'>
            <div class='panel-body'>
                @include('pictures.error_form') {!! Form::open(['url'=>'edit_order
                ','class'=>'form-horizontal']) !!} @include('orders.edit_order_form')
                <div class='form-group'>
                    <div class='col-md-6'>
                        {!! Form::submit('Edytuj zlecenie',['class'=>'btn btn-primary', ]) !!} {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
        </div>
</div>

@stop