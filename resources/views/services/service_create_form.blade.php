<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('name','Nazwa usługi:') !!}
        </div>
        <div class='col-md-12'>
                {!! Form::text('name',null,['class'=>'form-control','required' =>true]) !!}
        </div>
</div>

</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('price','Cena:') !!}
        </div>
        <div class='col-md-12 col-sm-12 form-select-control'>
                {!! Form::text('price',null,['class'=>'form-control','required' =>true]) !!}
        </div>
</div>