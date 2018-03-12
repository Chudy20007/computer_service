<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('name','Service name:') !!}
        </div>
        <div class='col-md-12'>
                {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
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