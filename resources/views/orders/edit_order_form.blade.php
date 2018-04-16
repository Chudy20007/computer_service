<div class='form-group'>
    <div class='col-md-4 control-label'>
            {!! Form::label('customer_id','Klient:') !!}
    </div>
    <div class='col-md-12 col-sm-12 form-select-control'>
            {!! Form::select('customer_id' ,$customers,['class'=>'form-select-control', /*'multiple'=>'multiple' */]) !!}
    </div>

    <div class='col-md-4 control-label'>
        {!! Form::label('employee_id','Pracownik:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
        {!! Form::select('employee_id' ,$employees,['class'=>'form-select-control', /*'multiple'=>'multiple' */]) !!}
</div>

    <div class='col-md-4 control-label'>
        {!! Form::label('status','Status zlecenia:') !!}
</div>
    <div class='col-md-12 col-sm-12 form-select-control'>
        {!! Form::select('status' ,array('aktywne'=>'aktywne','wstrzymane'=>'wstrzymane','zamknięte'=>'zamknięte','w toku'=>'w trakcie realizacji'),['class'=>'form-select-control']) !!}
</div>
<div class='col-md-4 control-label'>
    {!! Form::label('description','Opis zlecenia:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
    {!! Form::textarea('description' ,$order[0]->description,['class'=>'form-select-control']) !!}
</div>
{!! Form::hidden('order_id' ,$order[0]->id,['class'=>'form-select-control']) !!}
</div>