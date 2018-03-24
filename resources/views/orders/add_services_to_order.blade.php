@extends('main') @section('content')
<div class='row'>
        <div class='col-md-2'>
        </div>
    <div class='col-md-8 picture'>
        <div class='card'>
            <div class='panel-body'>
                @include('pictures.error_form') {!! Form::open(['url'=>'store_order_services','class'=>'form-horizontal']) !!} @include('orders.add_services_to_order_form')
                <div class='form-group'>
                    <div class='col-md-6'>
                        {!! Form::submit('Dodaj usługę do zlecenia',['class'=>'btn btn-primary']) !!} {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
        </div>
</div>

@stop