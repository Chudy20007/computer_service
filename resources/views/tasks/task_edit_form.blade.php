<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('title','Title:') !!}
        </div>
        <div class='col-md-12'>
                {!! Form::text('title',$task->title,['class'=>'form-control']) !!}
        </div>
</div>

</div>
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('description','Description:') !!}
        </div>
        <div class='col-md-12'>
                {!! Form::textarea('message',$task->message,['class'=>'form-control']) !!}
        </div>
</div>

@if (Auth::user()->isAdmin())
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('active','Active:') !!}
        </div>
        <div class='col-md-12 col-sm-12'>
                {{ Form::select('active', array('1'=>'yes','0'=>'no'),['class'=>'formOption']) }}
        </div>
</div>
@endif
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('selected_employee','Select employee:') !!}
        </div>
       
        <div class='col-md-12 col-sm-12 form-select-control'>
                {{ Form::select('employee_id' ,$employees,$task->employee_id,['class'=>'form-select-control']) }}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('selected_order','Select order:') !!}
        </div>
        <div class='col-md-12 col-sm-12 form-select-control'>
                {{ Form::select('order_id' ,$orders,$task->order_id,['class'=>'form-select-control']) }}
        </div>
        {!! Form::hidden('supervisor_id',Auth::id()) !!}
        {!! Form::hidden('id',$task->id) !!}
</div>