
<div class='form-group'>
        <div class='col-md-4 control-label'>
                {!! Form::label('complaints','Complaints:') !!}
        </div>
        <div class='col-md-12 col-sm-12 form-select-control'>
                {{ Form::file('file[]', array('multiple'=>true,'class'=>'formOption')) }}
                {{ Form::hidden('complaint_id',$complaint_id)}}
        </div>
</div>
