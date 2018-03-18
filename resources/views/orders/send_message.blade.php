@extends('main') @section('content')
<div class='row'>
        <div class='col-md-12 text-center'>
                <span class="form-header">Send message </span>
            </div>
        <div class='col-md-2'>
        </div>
    <div class='col-md-8 picture'>
        <div class='card'>
            <div class='panel-body'>
                @include('pictures.error_form') {!! Form::open(['url'=>'send_message','class'=>'form-horizontal']) !!}
                <div class='form-group'>
                    <div class='col-md-12'>
                            {!! Form::hidden('user_id',$user_id,['class'=>'form-control','class'=>'user_id']) !!} 
                            
                            {{ method_field('POST') }}
                            <div class='row'>
                                
                            <div class='col-md-12 text-center'>
                                    <br/>
                            {!! Form::textarea('message',null,['class'=>'form-select-control' /*'multiple'=>'multiple' */]) !!}
                            </div>
                        </div>  
                        <div class='row'>
                                
                                <div class='col-md-12 text-center'>
                                        
                            {!! Form::submit('Send message',['class'=>'btn btn-primary']) !!} {!! Form::close() !!}
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