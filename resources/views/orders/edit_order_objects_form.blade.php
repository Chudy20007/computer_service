@foreach ($objects as $object)

<div class='form-group panel-body'>
    <div class='col-md-4 control-label'>
            {!! Form::label('name'.$object->id,'Device:') !!}
    </div>
    <div class='col-md-12 col-sm-12 form-select-control'>
            {!! Form::text('name'.$object->id ,$object->name,['class'=>'form-select-control', /*'multiple'=>'multiple' */]) !!}
    </div>

    <div class='col-md-4 control-label'>
        {!! Form::label('serial_number'.$object->id,'Serial number:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
        {!! Form::text('serial_number'.$object->id ,$object->serial_number,['class'=>'form-select-control', /*'multiple'=>'multiple' */]) !!}
</div>

<div class='col-md-4 control-label'>
    {!! Form::label('diagnosis'.$object->id,'Diagnosis:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
    {!! Form::text('diagnosis'.$object->id ,$object->diagnosis,['class'=>'form-select-control', /*'multiple'=>'multiple' */]) !!}
</div>
<div class='col-md-4 control-label'>
    {!! Form::label('fixed'.$object->id,'Fixed:') !!}
</div>
<div class='col-md-12 col-sm-12 form-select-control'>
        {!! Form::select('fixed'.$object->id ,array('1'=>'true','0'=>'false'),['class'=>'form-select-control']) !!}
        {!! Form::hidden('object_id'.$object->id ,$object->id,['class'=>'form-select-control']) !!} 
</div>

</div>
@endforeach
{!! Form::hidden('id' ,$objects[0]->order_id,['class'=>'form-select-control']) !!}