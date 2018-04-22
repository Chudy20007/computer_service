
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('price','Klient:') !!}
        </div>
        <div class='col-md-12 col-sm-12 form-select-control'>
                {!! Form::select('customer',$customer,$order->customer->id,['class'=>'select-2 form-select-control']) !!}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('payment_method','Metoda płatności:') !!}
        </div>
        <div class='col-md-12 col-sm-12'>
                {!! Form::select('payment_method',['cash'=>'gotówka','card'=>'karta kredytowa','czek'=>'czek'],null,['class'=>'select-2 form-select-control']) !!}
        </div>
</div>

                {{ Form::hidden('order_id',$order->id,['class'=>'form-select-control']) }}

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('employee_id','Pracownik:') !!}
        </div>
       
        <div class='col-md-12 col-sm-12 form-select-control'>
                {{ Form::select('employee_id' ,$employee,$order->employee->id,['class'=>'select-2 form-select-control']) }}
        </div>
</div>

