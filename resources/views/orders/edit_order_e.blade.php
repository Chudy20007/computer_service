@extends('main') @section('content')
<div class='row'>
        <div class='col-md-12 text-center'>
                <span class="form-header">Edytuj zamówienie </span>
            </div>
        <div class='col-md-2'>
        </div>
    <div class='col-md-8 picture'>
        <div class='card'>
            <div class='panel-body'>
                @include('pictures.error_form') {!! Form::open(['url'=>'edit_order
                ','class'=>'form-horizontal']) !!} @include('orders.edit_order_form_e')
                <div class='form-group text-center'>
                    <div class='col-md-12'>
                        {!! Form::submit('Edytuj zamówienie',['class'=>'btn btn-primary', ]) !!} {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
        </div>
</div>

@stop