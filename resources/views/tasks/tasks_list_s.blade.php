@extends('main') @section('content') 
@if (Session::has('account_updated'))
<div class='row alert alert-success card'>
  <div class='col-md-12 text-center'>
  <b>  {{Session::get('account_updated')}} </b>
  </div>
</div>
@endif
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">Order </th>
        <th scope="col">Title</th>
        <th scope="col">Supervisor</th>
        <th scope="col">Employee</th>
        <th scope="col">Message</th>
        <th scope="col">Added</th>
        <th scope="col">Updated</th>
        <th scope="col">Details</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tasks as $task)
      <tr class="table-light">
        <td><a href="{{URL::asset('order/'.$task->order->id)}}">{{$task->order->id}}</a></td>
        <td>{{$task->title}}</td>
        <td> {{$task->supervisor->name}}</td>
        <td> {{$task->employee->name}}</td>
        <td> {{$task->message}}</td>
        <td> {{$task->created_at}}</td>
        <td> {{$task->updated_at}}</td>     
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskDetails',$task->id]]) !!}
         {!! Form::submit('Details',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskEditForm',$task->id]]) !!}
          {!! Form::submit('Edit',['class'=>'btn btn-primary']) !!}
           {{ Form::close() }} </a>
         </td>
      </tr>
      @endforeach
   
    </tbody>
  </table>
</div>

@stop