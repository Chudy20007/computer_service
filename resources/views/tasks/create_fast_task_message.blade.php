<div class='row'>
    <div class='col-md-2'>
    </div>
<div class='col-md-8 picture'>
    <div class='card' style='margin-bottom:2rem'>
        <div class='panel-body '>
            @include('pictures.error_form') {!! Form::open(['url'=>'add_message','class'=>'form-horizontal']) !!} @include('tasks.task_message_form')
            <div class='form-group'>
                <div class='col-md-12 text-center'>
                    {!! Form::button('Wyślij wiadomość',['class'=>'btn btn-primary btn-send-task-message']) !!}
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
        {!! Form::open(['url'=>'get_messages','class'=>'form-horizontal']) !!}
        {!! Form::hidden('task_id',$hiddenValues['task_id'],['class'=>'form-control','class'=>'task_id']) !!} 
        {{ method_field('POST') }}
         {!! Form::button('Odśwież',['class'=>'btn btn-primary btn-refresh-task-message']) !!}
         {!! Form::close() !!}
    </div>
</div>
<div class='col-md-2'>
    </div>
</div>
