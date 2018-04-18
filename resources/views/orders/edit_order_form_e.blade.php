<div class='form-group'>
        {!! Form::hidden('employee_id' ,$order[0]->employee_id,['class'=>'form-select-control', /*'multiple'=>'multiple' */]) !!}
        {!! Form::hidden('customer_id' ,$order[0]->customer_id,['class'=>'form-select-control', /*'multiple'=>'multiple' */]) !!}
    <div class='col-md-4 control-label'>
        {!! Form::label('status','Status zamówienia:') !!}
</div>
    <div class='col-md-12 col-sm-12 form-select-control'>
        {!! Form::select('status' ,array('active'=>'aktywne','break'=>'wstrzymane','closed'=>'zamknięte','in progress'=>'w trakcie realizacji'),null,['class'=>'form-select-control select-2']) !!}
</div>
<div class='col-md-4 control-label'>
    {!! Form::label('description','Opis zlecenia:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
    {!! Form::textarea('description' ,$order[0]->description,['class'=>'form-select-control']) !!}
</div>
{!! Form::hidden('order_id' ,$order[0]->id,['class'=>'form-select-control']) !!}
</div>