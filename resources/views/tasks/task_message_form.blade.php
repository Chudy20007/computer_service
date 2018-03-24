<div class='form-group text-center'>
        
        <div class='col-md-12 control-label'>
                {!! Form::label('message','Wiadomość:') !!}
        </div>
        <div class='col-md-12'>
                {!! Form::textarea('message',null,['class'=>'form-control','minlength'=>'8']) !!}
        </div>
        {!! Form::hidden('task_id',$hiddenValues['task_id'],['class'=>'form-control','id'=>'task_id']) !!} 
        {!! Form::hidden('user_id',$hiddenValues['user_id'],['class'=>'form-control','id'=>'user_id'])
        !!}
                {!! Form::hidden('order_id',$hiddenValues['order_id'],['class'=>'form-control','id'=>'order_id'])
                !!}
</div>