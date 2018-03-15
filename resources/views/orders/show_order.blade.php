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
        <th scope="col">Customer name</th>      
        <th scope="col">Order status</th>
        <th scope="col">Item name</th>
        <th scope="col">S/N</th>
        <th scope="col">Diagnosis</th>
        <th scope="col">Fixed</th>
        <th scope="col">Description</th>
        <th scope="col">Employee</th>
        <th scope="col">Edit</th>
        <th scope="col">Send Message</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      @foreach ($order->order_object as $object)
      <tr class="table-light">
        <td> <a href="{{URL::asset('order/'.$order->id)}}"> {{$order->id}}</a></td>
        <td><a href="{{URL::asset('user/'.$order->customer->id)}}">{{$order->customer->name}}</a></td>
        <td> {{$order->status}}</td>
        <td> {{$object->name}}</td>
        <td> {{$object->serial_number}}</td>
        <td> {{$object->diagnosis}}</td>
        <td> {{$object->fixed}}</td>
        <td> {{$order->description}}</td>
        <td> {{$order->employee->name}}</td>     
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$order->id]]) !!} {!!
          Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Create',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
                
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$order->id]]) !!} {!!
          Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Send',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
      </tr>
      @endforeach
      @endforeach
      @if (Auth::user()->isAdmin())
  <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@edit',$order->id]]) !!} {!!
          Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Edit',['class'=>'btn btn-info']) !!}
          {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@destroy',$order->id]]) !!}
          {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::hidden('_method','DELETE',['class'=>'form-control'])
          !!} {!! Form::submit('Deactivate',['class'=>'btn btn-info']) !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['AdminController@activate',$order->id]]) !!}
          {!! Form::hidden('_method','PATCH',['class'=>'form-control'])
          !!}
          {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Activate',['class'=>'btn btn-info']) !!} {{ Form::close() }} </a>
        </td>
     @endif
    </tbody>
  </table>
</div>

@stop