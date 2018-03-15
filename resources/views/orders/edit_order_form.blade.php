<div class='form-group'>
    <div class='col-md-4 control-label'>
            {!! Form::label('customer_id','Customer:') !!}
    </div>
    <div class='col-md-12 col-sm-12 form-select-control'>
            {!! Form::select('customer_id' ,$customers,['class'=>'form-select-control', /*'multiple'=>'multiple' */]) !!}
    </div>

    <div class='col-md-4 control-label'>
        {!! Form::label('employee_id','Employee:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
        {!! Form::select('employee_id' ,$employees,['class'=>'form-select-control', /*'multiple'=>'multiple' */]) !!}
</div>

    <div class='col-md-4 control-label'>
        {!! Form::label('status','Order status:') !!}
</div>
    <div class='col-md-12 col-sm-12 form-select-control'>
        {!! Form::select('status' ,array('active'=>'active','pause'=>'pause','in_progress'=>'in progress'),['class'=>'form-select-control']) !!}
</div>
<div class='col-md-4 control-label'>
    {!! Form::label('description','Order description:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
    {!! Form::textarea('description' ,$order[0]->description,['class'=>'form-select-control']) !!}
</div>
{!! Form::hidden('order_id' ,$order[0]->id,['class'=>'form-select-control']) !!}
</div>