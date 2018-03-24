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
        <th scope="col">Klient</th>
        <th scope="col">E-mail</th>
        <th scope="col">Telefon</th>
        <th scope="col">Status zamówienia</th>
        <th scope="col">Opis</th>
        <th scope="col">Pracownik</th>
        <th scope="col">Utwórz wątek</th>

        <th scope="col">Edytuj</th>
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
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Utwórz wątek',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderEditForm',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Edytuj zamówienie',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>

        @endforeach
    </tbody>
  </table>
</div>

@stop