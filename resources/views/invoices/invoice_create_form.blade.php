
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('price','Customer:') !!}
        </div>
        <div class='col-md-12 col-sm-12 form-select-control'>
                {!! Form::select('customer',$customer,$order->customer->id,['class'=>'form-select-control']) !!}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('payment_method','Payment:') !!}
        </div>
        <div class='col-md-12 col-sm-12'>
                {!! Form::select('payment_method',['cash'=>'cash','card'=>'card','checks'=>'checks'],['class'=>'form-control']) !!}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('tax','Tax(%):') !!}
        </div>
        <div class='col-md-12 col-sm-12'>
                {!! Form::select('tax',['23'=>'23%','8'=>'8%'],['class'=>'form-control']) !!}
        </div>
</div>

                {{ Form::hidden('order_id',$order->id,['class'=>'form-select-control']) }}

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('employee_id','Select employee:') !!}
        </div>
       
        <div class='col-md-12 col-sm-12 form-select-control'>
                {{ Form::select('employee_id' ,$employee,$order->employee->id,['class'=>'form-select-control']) }}
        </div>
</div>

