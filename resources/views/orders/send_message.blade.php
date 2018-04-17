@extends('main') @section('content')
<div class='row'>
        <div class='col-md-12 text-center'>
                <span class="form-header"> Wyślij wiadomość e-mail </span>
            </div>
        <div class='col-md-2'>
        </div>
    <div class='col-md-8 picture'>
        <div class='card'>
            <div class='panel-body'>
                @include('pictures.error_form') {!! Form::open(['url'=>'send_message','files' => true,'class'=>'form-horizontal']) !!}
                <div class='form-group'>
                    <div class='col-md-12'>
                            {!! Form::hidden('user_id',$user_id,['class'=>'form-control','class'=>'user_id']) !!} 
                            
                            {{ method_field('POST') }}
                            <div class='row'>
                                
                            <div class='col-md-12 text-center'>
                                    <br/>
                            {!! Form::textarea('message',null,['class'=>'form-select-control' /*'multiple'=>'multiple' */]) !!}
                            </div>
                            <div class='col-md-12 text-center'>
                                <br/>
                                {{ Form::file('file[]', array('multiple'=>true,'class'=>'formOption form-control')) }}
                        </div>
                         
                        </div>  
                        <div class='row'>
                                
                                <div class='col-md-12 text-center'>
                                        
                            {!! Form::submit('Wyślij wiadomość e-mail',['class'=>'btn btn-primary']) !!} {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-2'>
        </div>
</div>

@stop