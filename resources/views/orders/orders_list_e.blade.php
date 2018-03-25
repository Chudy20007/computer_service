@extends('main') @section('content') 
@include ("pictures.success_form")
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
        <th scope="col">Edytuj</th>
        <th scope="col">Usługi</th>
        <th scope="col">Części</th>
        <th scope="col">Przedmioty</th>
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
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Edytuj zlecenie',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderServicesList',$order->id]])
            !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Pokaż usługi',['class'=>'btn btn-primary'])
            !!} {{ Form::close() }} </a>
          </td>
          <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderPartsList',$order->id]])
            !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Pokaż części',['class'=>'btn btn-primary'])
            !!} {{ Form::close() }} </a>
          </td>
          <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['OrderController@showOrderObjectsList',$order->id]])
            !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Pokaż przedmioty',['class'=>'btn btn-primary'])
            !!} {{ Form::close() }} </a>
          </td>

        @endforeach
    </tbody>
  </table>
</div>

@stop