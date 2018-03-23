<div class='form-group'>
        {!! Form::hidden('employee_id' ,$order[0]->employee_id,['class'=>'form-select-control', /*'multiple'=>'multiple' */]) !!}
        {!! Form::hidden('customer_id' ,$order[0]->customer_id,['class'=>'form-select-control', /*'multiple'=>'multiple' */]) !!}
    <div class='col-md-4 control-label'>
        {!! Form::label('status','Order status:') !!}
</div>
    <div class='col-md-12 col-sm-12 form-select-control'>
        {!! Form::select('status' ,array('active'=>'active','pause'=>'pause','closed'=>'closed','in_progress'=>'in progress'),['class'=>'form-select-control']) !!}
</div>
<div class='col-md-4 control-label'>
    {!! Form::label('description','Order description:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
    {!! Form::textarea('description' ,$order[0]->description,['class'=>'form-select-control']) !!}
</div>
{!! Form::hidden('order_id' ,$order[0]->id,['class'=>'form-select-control']) !!}
</div>