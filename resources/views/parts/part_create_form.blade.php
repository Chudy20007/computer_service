<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('name','Part name:') !!}
        </div>
        <div class='col-md-12'>
                {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
</div>
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('price','Price:') !!}
        </div>
        <div class='col-md-12 col-sm-12 form-select-control'>
                {!! Form::text('price',null,['class'=>'form-control']) !!}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('serial_number','Serial number:') !!}
        </div>
        <div class='col-md-12 col-sm-12'>
                {!! Form::text('serial_number',null,['class'=>'form-control']) !!}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('count','Count:') !!}
        </div>
        <div class='col-md-12 col-sm-12'>
                {!! Form::text('count',null,['class'=>'form-control']) !!}
        </div>
</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('category_id','Select category:') !!}
        </div>
       
        <div class='col-md-12 col-sm-12 form-select-control'>
                {{ Form::select('category_id' ,$categories,null,['class'=>'form-select-control']) }}
        </div>
</div>

