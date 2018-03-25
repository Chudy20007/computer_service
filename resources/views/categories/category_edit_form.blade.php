<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('name','Nazwa kategorii:') !!}
        </div>
        <div class='col-md-12'>
                        {{ method_field('PATCH') }}
                {!! Form::text('name',$category->name,['class'=>'form-control','required' =>true]) !!}
                {!! Form::hidden('id',$category->id,['class'=>'form-control','required' =>true]) !!}
        </div>
</div>

</div>

