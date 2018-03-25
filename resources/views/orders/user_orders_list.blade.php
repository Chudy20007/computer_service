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
        <th scope="col">Numer zlecenia</th>
        <th scope="col">Klient</th>
        <th scope="col">E-mail</th>
        <th scope="col">Telefon</th>
        <th scope="col">Status zlecenia</th>
        <th scope="col">Opis</th>
        <th scope="col">Pracownik</th>
        <th scope="col">Wyślij wiadomość e-mail</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr class="table-light">

        <td> <a href="{{URL::asset('order/'.$order->id)}}"> {{$order->id}}</a></td>
        <td><a href="{{URL::asset('user/'.$order->customer->id)}}">{{$order->customer->name}}</a></td>
        <td>{{$order->customer->email}}</td>
        <td> {{$order->customer->phone}}</td>
        <td> {{$order->status}}</td>
        <td> {{$order->description}}</td>
        <td><a href="{{URL::asset('user/'.$order->employee->id)}}"> {{$order->employee->name}}</a></td>     
                
        <td> {!! Form::open(['method'=>'POST','class'=>'form-horizontal','action'=>['OrderController@showMessageForm',$order->id]]) !!} {!!
          Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Wyślij wiadomość',['class'=>'btn btn-primary']) !!}
          {{ Form::close() }} </a>
        </td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
</div>

@stop