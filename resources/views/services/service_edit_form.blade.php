<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('name','Service name:') !!}
        </div>
        <div class='col-md-12'>
                {!! Form::text('name',$service->name,['class'=>'form-control']) !!}
        </div>
</div>

</div>

<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('price','Price:') !!}
        </div>
        <div class='col-md-12 col-sm-12 form-select-control'>
                {!! Form::text('price',$service->price,['class'=>'form-control']) !!}
                {!! Form::hidden('id',$service->id,['class'=>'form-control']) !!}
                {{ method_field('PATCH') }}
        </div>
</div>