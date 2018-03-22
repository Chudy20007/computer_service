@extends('main') @section('content') @if (Session::has('account_updated'))
<div class='row alert alert-success card'>
  <div class='col-md-12 text-center'>
    <b> {{Session::get('account_updated')}} </b>
  </div>
</div>
@endif
<div class="table-responsive">
  <table class="table table- bordered table-hover">


    <thead class="bg-primary text-center">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Customer name</th>
        <th scope="col">E-mail</th>
        <th scope="col">Phone</th>
        <th scope="col">Order status</th>
        <th scope="col">Description</th>
        <th scope="col">Employee</th>
        <th scope="col">Edit</th>
        <th scope="col">Services</th>
        <th scope="col">Parts</th>
        <th scope="col">Objects</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr class="table-light">
        <td>
          <a href="{{URL::asset('order/'.$order->id)}}"> {{$order->id}}</a>
        </td>
        <td>
          <a href="{{URL::asset('user/'.$order->customer->id)}}">{{$order->customer->name}}</a>
        </td>
        <td>{{$order->customer->email}}</td>
        <td> {{$order->customer->phone}}</td>
        <td> {{$order->status}}</td>
        <td> {{$order->description}}</td>
        <td> {{$order->employee->name}}</td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderEditForm',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Edit',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderServicesList',$order->id]])
            !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Show',['class'=>'btn btn-primary'])
            !!} {{ Form::close() }} </a>
          </td>
          <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderPartsList',$order->id]])
            !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Show',['class'=>'btn btn-primary'])
            !!} {{ Form::close() }} </a>
          </td>
          <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderObjectsList',$order->id]])
            !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Show',['class'=>'btn btn-primary'])
            !!} {{ Form::close() }} </a>
          </td>

        @endforeach
    </tbody>
  </table>
</div>

@stop