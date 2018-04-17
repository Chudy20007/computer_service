<div class='form-group'>
    <div class='col-md-4 control-label'>
            {!! Form::label('customer_id','Klient:') !!}
    </div>
    <div class='col-md-12 col-sm-12 form-select-control'>
            {!! Form::select('customer_id' ,$customers,$order[0]->customer_id,['class'=>'form-select-control select-2']) !!}
    </div>

    <div class='col-md-4 control-label'>
        {!! Form::label('employee_id','Pracownik:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
        {!! Form::select('employee_id' ,$employees,$order[0]->employee_id,['class'=>'form-select-control select-2']) !!}
</div>

    <div class='col-md-4 control-label'>
        {!! Form::label('status','Status zlecenia:') !!}
</div>
    <div class='col-md-12 col-sm-12 form-select-control'>
        {!! Form::select('status' ,array('aktywne'=>'aktywne','wstrzymane'=>'wstrzymane','zamknięte'=>'zamknięte','w toku'=>'w trakcie realizacji'),$order[0]->status,['class'=>'select-2 form-select-control']) !!}
</div>
<div class='col-md-4 control-label'>
    {!! Form::label('description','Opis zlecenia:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
    {!! Form::textarea('description' ,$order[0]->description,null,['class'=>'form-select-control']) !!}
</div>
{!! Form::hidden('order_id' ,$order[0]->id,null,['class'=>'form-select-control']) !!}
</div>