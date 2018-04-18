<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('title','Tytuł:') !!}
        </div>
        <div class='col-md-12'>
                {!! Form::text('title',null,['class'=>'form-control','required' =>true]) !!}
        </div>
</div>

</div>
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('description','Opis:') !!}
        </div>
        <div class='col-md-12'>
                {!! Form::textarea('message',null,['class'=>'form-control','required' =>true]) !!}
        </div>
</div>

@if (Auth::user()->isAdmin())
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('active','Aktywny:') !!}
        </div>
        <div class='col-md-12 col-sm-12'>
                {{ Form::select('active', array('1'=>'tak','0'=>'nie'),null,['class'=>'form-select-control select-2','required' =>true]) }}
        </div>
</div>
@endif
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('selected_employee','Wybierz pracownika:') !!}
        </div>
       
        <div class='col-md-12 col-sm-12 form-select-control'>
                {{ Form::select('employee_id' ,$employees,Auth::id(),['class'=>'form-select-control select-2','required' =>true]) }}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('selected_order','Wybierz zlecenie:') !!}
        </div>
        <div class='col-md-12 col-sm-12 form-select-control'>
                {{ Form::select('order_id' ,$orders,$id,['class'=>'form-select-control select-2']) }}
        </div>
</div>