@extends('main') @section('content') 
@if (Session::has('account_updated'))
<div class='row alert alert-success card'>
  <div class='col-md-12 text-center'>
  <b>  {{Session::get('account_updated')}} </b>
  </div>
</div>
@endif

<div class='row rowPictures text-center'>
    <div class='col-md-12 col-sm-12 picture'>

        @if (session('status'))
        <div class="alert alert-success">
            <h4> {{ session('status') }} </h4>
        </div>
        @endif
         @if ((count($task_messages)>0)) 
        <div class='row'>
            <div class='col-md-12 col-sm-12'>
                <blockquote>
                    <b> {{$task_messages[0]->task->title}}</b>
                    
                </blockquote>
            </div>


        </div>

        <div class="card-footer author">
                @php $i=0; @endphp
              
            @foreach($task_messages as $message)
            
            <div class='div-comments text-left'>
                <blockquote class="mycode_quote">
                    <cite>
                        <span> ({{$message->updated_at}})</span>
                        <a href="{{URL::asset('/user/'.$message->employee->id)}}" class="quick_jump">
                            <img class="small-img" src="{{ URL::asset('css/img/avatars/'.$message->employee->id.".jpg ")}}">{{$message->employee->name}}</a> wrote: {{$message->message }}</cite>
                </blockquote>
  

            </div>


@php $i++; @endphp
            @endforeach 
            @php

            $hiddenValues=[
                'user_id'=>Auth::id(),
                'task_id'=>$task_messages[0]->task_id,
                'order_id'=>$task_messages[0]->order_id
            ];
            @endphp
                @endif 
                @include('tasks.create_fast_task_message')
        </div>
    </div>
</div>

@stop