<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('name','Category name:') !!}
        </div>
        <div class='col-md-12'>
                {!! Form::text('name',$categories[0]->name,['class'=>'form-control']) !!}
                {!! Form::hidden('id',$categories[0]->id,['class'=>'form-control']) !!}
        </div>
</div>

</div>

