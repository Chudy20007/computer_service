
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('invoices','Invoices:') !!}
        </div>
        <div class='col-md-12 col-sm-12 form-select-control'>
                {{ Form::file('file[]', array('multiple'=>true,'class'=>'formOption')) }}
                {{ Form::hidden('invoice_id',$invoice_id)}}
        </div>
</div>
