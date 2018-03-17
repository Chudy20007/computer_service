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
        <th scope="col">ID</th>
        <th scope="col">Order ID</th>
        <th scope="col">Name</th>
        <th scope="col">Serial number</th>
        <th scope="col">Diagnosis</th>
        <th scope="col">Fixed</th>
        <th scope="col">Created</th>
        <th scope="col">Updated</th>
        <th scope="col">Edit</th>
        <th scope="col">Send Message</th>
      </tr>
    </thead>
    <tbody>
      @foreach($objects as $object)
      <tr class="table-light">
          <td>{{$object->id}}</td>
        <td> <a href="{{URL::asset('order/'.$object->order_id)}}"> {{$object->order_id}}</a></td>
        <td>{{$object->name}}</td>
        <td> {{$object->serial_number}}</td>
        <td> {{$object->diagnosis}}</td>
        <td> {{$object->fixed==true ?'yes' :'no'}}</td>
        <td> {{$object->created_at}}</td>     
        <td> {{$object->updated_at}}</td> 
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderObjectsEditForm',$object->order_id]]) !!} {!!
          Form::hidden('id',$object->id,['class'=>'form-control']) !!} {!! Form::submit('Edit objects',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
                
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$object->id]]) !!} {!!
          Form::hidden('id',$object->id,['class'=>'form-control']) !!} {!! Form::submit('Send',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
      </tr>
      @endforeach
    
    </tbody>
  </table>
</div>

@stop