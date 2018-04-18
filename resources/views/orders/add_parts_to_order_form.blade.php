<div class='form-group'>
    <div class='col-md-4 control-label'>
            {!! Form::label('part_id','Wybierz części:') !!}
    </div>
    <div class='col-md-12 col-sm-12 form-select-control'>
            {!! Form::select('part_id' ,$parts,null,['class'=>'form-select-control select-2', /*'multiple'=>'multiple' */]) !!}
    </div>

    <div class='col-md-4 control-label'>
                {!! Form::label('count','Sztuk:') !!}
        </div>
            <div class='col-md-12 col-sm-12 form-select-control'>
                {!! Form::number('count',1,['min'=>'1','class'=>'form-control select-2']) !!}
        </div>

    <div class='col-md-4 control-label'>
        {!! Form::label('order_id','Wybierz zamówienie (przedmiot):') !!}
</div>
    <div class='col-md-12 col-sm-12 form-select-control'>
        {!! Form::select('order_id' ,$orders,$order_id,['class'=>'form-select-control select-2']) !!}
</div>


</div>