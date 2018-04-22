@extends('main') @section('content') 
@include ("pictures.success_form")
<div class="table-responsive2">
  <table class="table table-hover">


    <thead class="bg-primary text-center">
      <tr data-table='orders_e'>
        <th scope="col" data-name="id" data-sort="asc">ID</th>
        <th scope="col" data-name="customer_id" data-sort="asc">Klient</th>
        <th scope="col" data-name="email" data-sort="asc">E-mail</th>
        <th scope="col" data-name="phone" data-sort="asc">Telefon</th>
        <th scope="col" data-name="status" data-sort="asc">Status zamówienia</th>
        <th scope="col" data-name="description" data-sort="asc">Opis</th>
        <th scope="col" data-name="execution_time" data-sort="asc">Termin realizacji</th>
        <th scope="col" data-name="received" data-sort="asc">Przedmiot odebrano</th>
        <th scope="col" data-name="employee_id" data-sort="asc">Pracownik</th>
        <th scope="col">Utwórz wątek</th>
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
        <td> {{$order->execution_time}}</td>
        <td> {{($order->received==true? 'tak':'nie')}}</td>
        <td> {{$order->employee->name}}</td>
        <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['TaskController@showTaskForm',$order->id]])
          !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Utwórz wątek',['class'=>'btn btn-primary'])
          !!} {{ Form::close() }} </a>
        </td>
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
          <td> {!! Form::open(['method'=>'get','class'=>'form-horizontal','action'=>['InvoiceController@showInvoiceForm',$order->id]])
            !!} {!! Form::hidden('id',$order->id,['class'=>'form-control']) !!} {!! Form::submit('Utwórz podsumowanie',['class'=>'btn btn-primary'])
            !!} {{ Form::close() }} </a>
          </td>

        @endforeach
    </tbody>
  </table>
</div>

@stop