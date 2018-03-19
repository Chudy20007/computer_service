<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('name','Category name:') !!}
        </div>
        <div class='col-md-12'>
                        {{ method_field('PATCH') }}
                {!! Form::text('name',$category->name,['class'=>'form-control']) !!}
                {!! Form::hidden('id',$category->id,['class'=>'form-control']) !!}
        </div>
</div>

</div>

