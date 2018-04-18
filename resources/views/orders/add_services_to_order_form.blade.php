<div class='form-group'>
    <div class='col-md-4 control-label'>
            {!! Form::label('service_id','Wybierz usługi:') !!}
    </div>
    <div class='col-md-12 col-sm-12 form-select-control'>
            {{ Form::select('service_id[]' ,$services,null,['class'=>'form-select-control','multiple'=>'multiple']) }}
    </div>
    <div class='col-md-4 control-label'>
        {!! Form::label('service_id','Wybierz zlecenie (urządzenie):') !!}
</div>
    <div class='col-md-12 col-sm-12 form-select-control'>
        {{ Form::select('order_id' ,$orders,$order_id,['class'=>'form-select-control select-2']) }}
</div>
</div>