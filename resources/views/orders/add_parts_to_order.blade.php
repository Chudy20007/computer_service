@extends('main') @section('content')
<div class='row'>
        <div class='col-md-12 text-center'>
                <span class="form-header"> Dodaj przedmioty do zlecenia </span>
            </div>
        <div class='col-md-2'>
        </div>
    <div class='col-md-8 picture'>
        <div class='card'>
            <div class='panel-body'>
                @include('pictures.error_form') {!! Form::open(['url'=>'store_order_parts
                ','class'=>'form-horizontal']) !!} @include('orders.add_parts_to_order_form')
                <div class='form-group'>
                    <div class='col-md-6'>
                        {!! Form::button('Dodaj przedmioty do zlecenia',['class'=>'btn btn-primary form_button', ]) !!} {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
        </div>
</div>

@stop