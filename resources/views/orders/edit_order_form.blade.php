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
    <select class='select-2 select-2-longest form-select-control employee_id' id='employee_id' name='employee_id'>
      @foreach($employees as $employee)
    <option value='{{$employee->id}}'>{{$employee->name}} =>  ilość aktualnie realizowanych zleceń: <b>{{$employee->order_employee_count()}}</b></option>

      @endforeach
    </select>
</div>

    <div class='col-md-4 control-label'>
        {!! Form::label('status','Status zlecenia:') !!}
</div>
    <div class='col-md-12 col-sm-12 form-select-control'>
        {!! Form::select('status' ,array('aktywne'=>'aktywne','wstrzymane'=>'wstrzymane','zamknięte'=>'zamknięte','w toku'=>'w trakcie realizacji'),$order[0]->status,['class'=>'select-2 form-select-control']) !!}
</div>

<div class='col-md-4 control-label'>
        {!! Form::label('execution_time','Czas realizacji zlecenia:') !!}
    </div>
    <div class='col-md-12 col-sm-12 form-select-control'>
    <input type="date" name="execution_time" id="execution_time" class="form-select-control select-2 execution_time" value='<?php echo $order[0]->execution_time ?>'>
    </div>

<div class='col-md-4 control-label'>
    {!! Form::label('received','Przedmiot odebrany:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
    {!! Form::select('received' ,array('1'=>'tak','0'=>'nie'),$order[0]->received,['class'=>'select-2 form-select-control']) !!}
</div>
<div class='col-md-4 control-label'>
    {!! Form::label('description','Opis zlecenia:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
    {!! Form::textarea('description' ,$order[0]->description,null,['class'=>'form-select-control']) !!}
</div>
{!! Form::hidden('order_id' ,$order[0]->id,null,['class'=>'form-select-control']) !!}
</div>